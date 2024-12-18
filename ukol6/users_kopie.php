<?php
include "includes/nav.php";
include "includes/session.php";
include "includes/session_check.php";
include "includes/db.php"; // Připojení k databázi
?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seznam uživatelů</title>
</head>

<body>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3">
        <h1>Uživatelé</h1>

        <!-- Tlačítko pro přidání uživatele -->
        <a href="add_user" class="btn btn-primary mb-3">Přidat uživatele</a>

        <?php
        // Příprava SQL dotazu
        $sql = "SELECT id, jmeno, prijmeni, email, telefon, pracovna, popisek FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        // Zobrazení výsledků v tabulce
        if ($result->num_rows > 0) {
            echo "<table class='table table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col'>ID</th>";
            echo "<th scope='col'>Jméno</th>";
            echo "<th scope='col'>Příjmení</th>";
            echo "<th scope='col'>Email</th>";
            echo "<th scope='col'>Telefon</th>";
            echo "<th scope='col'>Pracovna</th>";
            echo "<th scope='col'>Popisek</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["jmeno"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["prijmeni"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["telefon"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["pracovna"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["popisek"]) . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>Žádní uživatelé k zobrazení.</p>";
        }

        // Uzavření připojení
        $stmt->close();
        $conn->close();
        ?>
    </main>

</body>

</html>