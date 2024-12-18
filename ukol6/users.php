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

        <!-- Notifikace, pokud existuje -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="notification alert alert-success mt-3">
                <?php echo $_SESSION['success_message']; ?>
            </div>
            <?php unset($_SESSION['success_message']); ?> <!-- Odstraní notifikaci po zobrazení -->
        <?php endif; ?>

        <!-- Tlačítko pro přidání uživatele, viditelné pouze pro administrátory -->
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
            <a href="add_user.php" class="btn btn-primary mb-3">Přidat uživatele</a>
        <?php endif; ?>



        <?php
        // Příprava SQL dotazu pro načtení uživatelů
        $sql = "SELECT id, jmeno, prijmeni, email, telefon, pracovna, popisek FROM users";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            echo "Chyba při přípravě dotazu: " . $conn->error . "<br>";
        } else {
            //echo "Dotaz byl úspěšně připraven.<br>";
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
                echo "<th scope='col'>Akce</th>"; // Sloupec pro akce
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
                    echo "<td>";
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                        echo "<a href='edit_user?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Editovat</a> ";
                        // Vygenerování tlačítka pro smazání uživatele
                        echo "<a href='#' class='btn btn-danger btn-sm' data-id='" . $row["id"] . "' data-name='" . $row["jmeno"] . " " . $row["prijmeni"] . "'>Smazat</a>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>Žádní uživatelé k zobrazení.</p>";
            }

            $stmt->close();
        }

        $conn->close();
        ?>


        <dialog id="dialog" class="dialog">
            <p>Opravdu chcete smazat uživatele: <span id="dialog__item-to-delete"></span>?</p>
            <div class="dialog__actions">
                <a id="dialog__confirm-link" class="btn btn-danger">Smazat</a>
                <button onclick="closeDeleteDialog()" class="btn btn-secondary">Zrušit</button>
            </div>
        </dialog>
    </main>
</body>
<script>
    // Najdeme všechna tlačítka s třídou .btn-danger
    const deleteButtons = document.querySelectorAll(".btn-danger");

    deleteButtons.forEach(button => {
        button.addEventListener("click", () => {
            const userId = button.dataset.id; // ID uživatele z data atributu
            const userName = button.dataset.name; // Jméno uživatele z data atributu

            // Ladicí výstupy pro kontrolu hodnot
            console.log("userId:", userId); // Zkontroluj, zda je userId správně přiřazené
            console.log("userName:", userName); // Zkontroluj, zda je userName správně přiřazené

            if (!userId) {
                console.log("Chyba: userId není definováno");
                return; // Zamezíme otevření dialogu, pokud není ID
            }

            // Najdeme prvky dialogového okna
            const dialog = document.getElementById("dialog");
            const itemToDelete = document.getElementById("dialog__item-to-delete");
            const confirmLink = document.getElementById("dialog__confirm-link");

            // Nastavíme text s názvem uživatele
            itemToDelete.textContent = userName;

            // Nastavíme odkaz na akci mazání
            confirmLink.setAttribute("href", `delete_user.php?id=${userId}`);

            // Zobrazíme dialog
            dialog.showModal();
        });
    });
</script>

<!-- JavaScript pro fade-out efekt -->
<script>
    // Rekurzivní fade-out efekt
    const fadeOutEffect = (opacity = 1, delay = 30, decrement = 0.01) => {
        const notifications = document.querySelectorAll(".notification");

        if (opacity > 0) {
            notifications.forEach(n => n.style.opacity = opacity);
            setTimeout(() => fadeOutEffect(opacity - decrement, delay, decrement), delay);
        } else {
            notifications.forEach(n => n.style.display = "none");
        }
    };

    // Spustí fade-out efekt, pokud existuje notifikace
    window.addEventListener('DOMContentLoaded', () => {
        const notifications = document.querySelectorAll(".notification");
        if (notifications.length > 0) {
            fadeOutEffect();
        }
    });
</script>

</html>