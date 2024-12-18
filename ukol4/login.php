<?php
// připojení k lokální databázi (UNIX socket)
$db_host = 'localhost'; // $db_host = '127.0.0.1'; // pro TCP/IP spojení
$db_user = 'root';
$db_password = '';
$db_db = 'weba';
//$db_port = 8889; // pro TCP/IP spojení

$mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db,
    //$db_port // pro TCP/IP spojení
);

if ($mysqli->connect_error) {
    echo 'Error: ' . $mysqli->connect_error;
    exit();
}

echo 'Success: A proper connection to MySQL was made.';
echo '';
echo 'Host information: ' . $mysqli->host_info;
echo '';
echo 'Protocol version: ' . $mysqli->protocol_version;

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap.css" />
    <link rel="stylesheet" href="./bootstrap-icons.css" />
</head>

<body style="padding: 10em 10em; text-align: center;">

    <form action="" method="post">
        <!-- Email input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" name="jmeno" id="form2Example1" class="form-control" required />
            <label class="form-label" for="form2Example1">Email address</label>
        </div>

        <!-- Password input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="password" name="heslo" id="form2Example2" class="form-control" required />
            <label class="form-label" for="form2Example2">Password</label>
        </div>

        <!-- Submit button -->
        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Sign in</button>
    </form>

    <?php
    // Kontrola, zda byly odeslány údaje
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Získání hodnoty jména z POST
        $name = isset($_POST['jmeno']) ? $_POST['jmeno'] : '';
        // Výpis zprávy
        //echo "Hello $name";
        $_SESSION["jmeno"] = $name;
        $_SESSION["mysqli"] = $mysqli;
        header("Location: dashboard");
        exit;
    }
    ?>
</body>

</html>