<?php
session_start(); // Spuštění session
include "includes/header.php";
// Ověření, zda je v session nastaveno jméno uživatele
if (!isset($_SESSION['jmeno']) || empty($_SESSION['jmeno'])) {
    header("Location: index"); // Přesměrování na přihlašovací stránku
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main style="padding-left: 300px;">
        <?php
        $sql = "SELECT jmeno, email FROM users"; // Uprav podle skutečné struktury tabulky
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            // Začátek HTML tabulky
            echo '<table border="1" style="width: 100%; text-align: left; border-collapse: collapse;">';
            echo '<tr><th>ID</th><th>Jméno</th><th>Email</th></tr>';

            // Výpis dat každého uživatele
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . htmlspecialchars($row['jmeno']) . '</td>'; // Použij htmlspecialchars pro bezpečnost
                echo '<td>' . htmlspecialchars($row['email']) . '</td>'; // Použij htmlspecialchars pro bezpečnost
                echo '</tr>';
            }

            // Konec HTML tabulky
            echo '</table>';
        } else {
            echo '<h1>Žádní uživatelé nenalezeni.</h1>';
        }
        echo '<h1>Debugging...</h1>';
        echo '<h2>Jméno uživatele: ' . htmlspecialchars($_SESSION['jmeno']) . '</h2>';
        ?>
    </main>
</body>

</html>