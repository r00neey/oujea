<?php
ob_start();
include "includes/session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Přihlášení</title>
</head>
<style>
  form {
    display: flex;
    flex-direction: column;
    width: 200px;
    margin: 0 auto;
  }

  label {
    margin-bottom: 5px;
  }

  input {
    margin-bottom: 10px;
  }

  button {
    width: 100px;
    margin: 0 auto;
  }

  form {
    margin-top: 100px;
    border: 0.25em solid black;
    background-color: lightgray;
    padding: 2em;
    box-shadow: 1em 1em 1em darkgray;
  }
</style>

<body>
  <form action="" method="post">
    <label for="jmeno">Jméno:</label>
    <input type="text" name="jmeno" id="jmeno" required>
    <br>
    <label for="heslo">Heslo:</label>
    <input type="password" name="heslo" id="heslo" required>
    <br>
    <button type="submit">Login</button>
  </form>
</body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $jmeno = $_POST['jmeno'];
  $heslo = $_POST['heslo'];

  // Příprava a provedení SQL dotazu
  $sql = "SELECT * FROM users WHERE jmeno = ?";
  $stmt = $conn->prepare($sql);
  if ($stmt) {
    $stmt->bind_param("s", $jmeno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if (password_verify($heslo, $row['heslo'])) {
        // Přihlášení úspěšné
        $_SESSION['username'] = $jmeno;
        $_SESSION['admin'] = (int)$row['admin']; // Uložení admin statusu do session
        header("Location: dashboard");
        exit();
      } else {
        echo "Nesprávné heslo.<br>";
      }
    } else {
      echo "Uživatelské jméno neexistuje.<br>";
    }

    $stmt->close();
  } else {
    echo "Chyba při přípravě dotazu: " . $conn->error . "<br>";
  }
}

$conn->close();
ob_end_flush();
?>

</html>