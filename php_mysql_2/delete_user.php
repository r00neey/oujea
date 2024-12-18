<?php
include "includes/nav.php";
include "includes/session.php";
include "includes/session_check.php";

if (isset($_GET["id"])) {
    $user_id = $_GET["id"];

    // SQL příkaz pro smazání uživatele
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "Uživatel byl úspěšně smazán.";
    } else {
        echo "Chyba při mazání uživatele: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Přesměrování zpět na seznam uživatelů
    header("Location: users.php");
    exit();
}
