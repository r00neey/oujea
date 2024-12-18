<?php
include 'db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, UPDATE");
header("Access-Control-Allow-Headers: Content-Type");

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

error_log(print_r($_SESSION['users'], true));

function sendJSONResponse($data, $status = 200)
{
    http_response_code($status);
    echo json_encode($data);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];
$path = explode('/', trim($_SERVER['PATH_INFO'] ?? '', '/'));

switch ($method) {
    case 'GET':
        if (empty($path[0])) {
            sendJSONResponse(['error' => 'Invalid path'], 400);
        }
        if ($path[0] === 'get') {
            sendJSONResponse(array_values($_SESSION['users']));
        } elseif ($path[0] === 'get' && isset($path[1])) {
            $id = $path[1];
            if (isset($_SESSION['users'][$id])) {
                sendJSONResponse($_SESSION['users'][$id]);
            } else {
                sendJSONResponse(['error' => 'User not found'], 404);
            }
        }
        break;

    case 'POST':
        if ($path[0] === 'post') {
            if (isset($_POST['id'], $_POST['name'], $_POST['surname'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $surname = $_POST['surname'];

                if ($id === null) {
                    sendJSONResponse(['error' => 'ID cannot be null'], 400);
                }

                $_SESSION['users'][$id] = [
                    'id' => $id,
                    'name' => $name,
                    'surname' => $surname
                ];

                error_log(print_r($_SESSION['users'], true));

                sendJSONResponse(['success' => 'User added'], 201);
            } else {
                sendJSONResponse(['error' => 'Invalid data provided'], 400);
            }
        }
        break;

    case 'PUT':
        if ($path[0] === 'update' && isset($path[1])) {
            parse_str(file_get_contents("php://input"), $_PUT);
            $id = $path[1];
            if (isset($_SESSION['users'][$id])) {
                $_SESSION['users'][$id]['name'] = $_PUT['name'];
                $_SESSION['users'][$id]['surname'] = $_PUT['surname'];
                sendJSONResponse(['success' => 'User updated'], 200);
            } else {
                sendJSONResponse(['error' => 'User not found'], 404);
            }
        }
        break;

    case 'DELETE':
        if ($path[0] === 'delete' && isset($path[1])) {
            $id = $path[1];
            if (isset($_SESSION['users'][$id])) {
                unset($_SESSION['users'][$id]);
                sendJSONResponse(['success' => 'User deleted'], 200);
            } else {
                sendJSONResponse(['error' => 'User not found'], 404);
            }
        }
        break;

    default:
        sendJSONResponse(['error' => 'Invalid method'], 405);
        break;
}
