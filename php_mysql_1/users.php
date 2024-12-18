<?php
include "includes/nav.php";
include "includes/session.php";
include "includes/session_check.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3">
        <?php
        if (isset($_SESSION['username'])) {
            echo "<h1>Welcome, " . $_SESSION['username'] . "</h1>";
        } else {
            echo "<h1>Welcome, Guest</h1>";
        }
        ?>
    </main>
</body>

</html>