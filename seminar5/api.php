<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

function arrayToCsv($array)
{
    $output = fopen('php://output', 'w');
    fputcsv($output, $array);
    fclose($output);
}

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = trim($_SERVER['REQUEST_URI'], '/'); // Získáme čistou URI
$scriptName = trim($_SERVER['SCRIPT_NAME'], '/'); // Získáme jméno skriptu
$requestPath = str_replace($scriptName, '', $requestUri); // Odebereme jméno skriptu z URI
$requestPath = trim($requestPath, '/'); // Odstraníme přebytečné lomítko
$requestSegments = explode('/', $requestPath); // Rozdělíme na části

switch ($requestMethod) {
    case 'GET':
        // Debugging výstup (pro ověření)
        // var_dump($requestUri, $requestPath, $requestSegments);
        // exit;

        if (empty($requestSegments[0])) { // Pokud je cesta prázdná (např. /seminar5/api.php)
            header('Content-Type: text/csv');
            if (!empty($_SESSION['users'])) {
                foreach ($_SESSION['users'] as $user) {
                    arrayToCsv($user);
                }
            } else {
                echo "No users found.";
            }
        } elseif (count($requestSegments) === 1 && is_numeric($requestSegments[0])) { // Např. /seminar5/api.php/1
            $userId = (int)$requestSegments[0];
            if (isset($_SESSION['users'][$userId])) {
                header('Content-Type: text/csv');
                arrayToCsv($_SESSION['users'][$userId]);
            } else {
                http_response_code(404);
                echo "User not found";
            }
        } else {
            echo 'nespravna cesta'; // Nesprávná cesta
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id'], $data['name'], $data['surname']) && !isset($_SESSION['users'][$data['id']])) {
            $_SESSION['users'][$data['id']] = [
                'id' => $data['id'],
                'name' => $data['name'],
                'surname' => $data['surname']
            ];
            http_response_code(201);
            echo "User created";
        } else {
            http_response_code(400);
            echo "Invalid input or user ID - already exists";
        }
        break;

    case 'PUT':
        if (is_numeric($requestSegments[0])) { // Např. /seminar5/api.php/1
            $userId = (int)$requestSegments[0];
            $data = json_decode(file_get_contents("php://input"), true);

            if (isset($_SESSION['users'][$userId]) && isset($data['name'], $data['surname'])) {
                $_SESSION['users'][$userId]['name'] = $data['name'];
                $_SESSION['users'][$userId]['surname'] = $data['surname'];
                echo "User updated";
            } else {
                http_response_code(400);
                echo "Invalid input or user not found";
            }
        } else {
            http_response_code(400);
            echo "Invalid request";
        }
        break;

    case 'DELETE':
        if (is_numeric($requestSegments[0])) { // Např. /seminar5/api.php/1
            $userId = (int)$requestSegments[0];
            if (isset($_SESSION['users'][$userId])) {
                unset($_SESSION['users'][$userId]);
                echo "User deleted";
            } else {
                http_response_code(404);
                echo "User not found";
            }
        } else {
            http_response_code(400);
            echo "Invalid request";
        }
        break;

    default:
        http_response_code(405);
        echo "Method Not Allowed";
        break;
}
