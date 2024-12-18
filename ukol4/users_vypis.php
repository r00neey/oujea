<?php
// Připojení k databázi
$db_host = 'localhost';
$db_user = 'root';
$db_password = ''; // Zde nastav heslo
$db_db = 'weba';

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_db);

if ($mysqli->connect_error) {
    die('Connect Error: ' . $mysqli->connect_error);
}

// Dotaz pro získání všech uživatelů
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
    echo 'Žádní uživatelé nenalezeni.';
}

$mysqli->close();
