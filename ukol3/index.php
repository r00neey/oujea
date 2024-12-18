<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    //session_start();
    //$_SESSION["variable"] = 42;
    //$uri = $_SERVER['REQUEST_URI'];
    //echo $uri;

    // Získání hodnoty z navigace (např. z parametru URL)
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';


    // Použití switch pro výběr správné stránky
    switch ($page) {
        case 'items':
            include "includes/header.php";
            include 'items.php';
            break;
        case 'others':
            include "includes/header.php";
            include 'others.php';
            break;
        case 'users':
            include "includes/header.php";
            include 'users.php';
            break;
        default:
            include 'login.php';
            break;
    }
    ?>

</body>

</html>