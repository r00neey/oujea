<?php
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
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <button type="submit">Login</button>
  </form>
</body>

<?php
if (isset($_POST['username'])) {
  $_SESSION['username'] = $_POST['username'];
  header('Location: dashboard');
}
?>

</html>