<?php
include "includes/nav.php";
include "includes/session.php";
include "includes/db.php"; // Připojení k databázi

// Zpracování POST požadavku pro přidání uživatele
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Získání hodnot z formuláře a základní sanitizace
    $jmeno = htmlspecialchars($_POST["jmeno"]);
    $prijmeni = htmlspecialchars($_POST["prijmeni"]);
    $email = htmlspecialchars($_POST["email"]);
    $telefon = htmlspecialchars($_POST["telefon"]);
    $pracovna = htmlspecialchars($_POST["pracovna"]);
    $popisek = htmlspecialchars($_POST["popisek"]);
    $heslo = password_hash($_POST["heslo"], PASSWORD_DEFAULT); // Hashování hesla

    // SQL příkaz pro vložení dat
    $sql = "INSERT INTO users (jmeno, prijmeni, email, telefon, pracovna, popisek, heslo) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $jmeno, $prijmeni, $email, $telefon, $pracovna, $popisek, $heslo);

    // Spuštění dotazu a kontrola, zda se vložení povedlo
    if ($stmt->execute()) {
        header("Location: users.php");
    } else {
        echo "Chyba při přidávání uživatele: " . $stmt->error;
    }

    // Uzavření příkazu
    $stmt->close();
}

// Příprava pro načtení uživatelů z databáze atd.
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
        <h1>Přidání uživatele</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="jmeno" class="form-label">Jméno</label>
                <input type="text" class="form-control" id="jmeno" name="jmeno" required>
            </div>
            <div class="mb-3">
                <label for="prijmeni" class="form-label">Příjmení</label>
                <input type="text" class="form-control" id="prijmeni" name="prijmeni" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefon" class="form-label">Telefon</label>
                <input type="text" class="form-control" id="telefon" name="telefon" placeholder="Např. +420 123 456 789">
            </div>
            <div class="mb-3">
                <label for="pracovna" class="form-label">Pracovna</label>
                <input type="text" class="form-control" id="pracovna" name="pracovna">
            </div>
            <div class="mb-3">
                <label for="popisek" class="form-label">Popisek</label>
                <textarea class="form-control" id="popisek" name="popisek" rows="3" placeholder="Krátký popis"></textarea>
            </div>
            <div class="mb-3">
                <label for="heslo" class="form-label">Heslo</label>
                <input type="password" class="form-control" id="heslo" name="heslo" required>
            </div>
            <button type="submit" class="btn btn-primary">Přidat uživatele</button>
        </form>
    </main>
</body>

</html>