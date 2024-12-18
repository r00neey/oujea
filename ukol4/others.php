<?php
session_start(); // Spuštění session

// Ověření, zda je v session nastaveno jméno uživatele
if (!isset($_SESSION['jmeno']) || empty($_SESSION['jmeno'])) {
    header("Location: index"); // Přesměrování na přihlašovací stránku
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Simple Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="./bootstrap.css" />
    <link rel="stylesheet" href="./bootstrap-icons.css" />
</head>

<body>
    <?php
    include "includes/header.php";
    ?>
</body>

</html>