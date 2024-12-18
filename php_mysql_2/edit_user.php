<?php
include "includes/nav.php";
include "includes/session.php";
include "includes/session_check.php";

if (isset($_GET["id"])) {
    $user_id = $_GET["id"];

    // Načtení stávajících údajů
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jmeno = htmlspecialchars($_POST["jmeno"]);
    $prijmeni = htmlspecialchars($_POST["prijmeni"]);
    $email = htmlspecialchars($_POST["email"]);
    $telefon = htmlspecialchars($_POST["telefon"]);
    $pracovna = htmlspecialchars($_POST["pracovna"]);
    $popisek = htmlspecialchars($_POST["popisek"]);

    // Aktualizace uživatele
    $sql = "UPDATE users SET jmeno = ?, prijmeni = ?, email = ?, telefon = ?, pracovna = ?, popisek = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $jmeno, $prijmeni, $email, $telefon, $pracovna, $popisek, $user_id);

    if ($stmt->execute()) {
        echo "Uživatel byl úspěšně upraven.";
        header("Location: users.php");
        exit();
    } else {
        echo "Chyba při aktualizaci uživatele: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editace uživatele</title>
</head>

<body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3">
        <h1>Editace uživatele</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">Jméno:
                    <input class="form-control" type="text" name="jmeno" value="<?= htmlspecialchars($user['jmeno']) ?>" required></label>
            </div>
            <div class="mb-3"><label class="form-label">Příjmení:
                    <input class="form-control" type="text" name="prijmeni" value="<?= htmlspecialchars($user['prijmeni']) ?>" required></label></div>
            <div class="mb-3"><label class="form-label">Email:
                    <input class="form-control" type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required></label></div>
            <div class="mb-3"><label class="form-label">Telefon:
                    <input class="form-control" type="text" name="telefon" value="<?= htmlspecialchars($user['telefon']) ?>" maxlength="9" pattern="\d{9}" required></label></div>
            <div class="mb-3"><label class="form-label">Pracovna:
                    <input class="form-control" type="text" name="pracovna" value="<?= htmlspecialchars($user['pracovna']) ?>"></label></div>
            <div class="mb-3"><label class="form-label">Popisek:
                    <input class="form-control" type="text" name="popisek" value="<?= htmlspecialchars($user['popisek']) ?>"></label></div>
            <button type="submit" class="btn btn-primary">Uložit změny</button>
        </form>
    </main>
</body>

</html>