<?php

class LoginController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $conn;
            $username = $conn->real_escape_string($_POST['username']);
            $password = $_POST['password'];

            $user = User::findByEmail($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['is_admin'] = $user['is_admin'];
                $_SESSION['username'] = $user['email'];
                $_SESSION['authorized'] = true;

                User::updateLastLogin($user['id']);

                header("Location: index.php?page=dashboard");
                exit();
            } else {
                $_SESSION['error_message'] = "Nesprávné heslo nebo uživatel nenalezen.";
            }
        }

        include 'views/login.php';
    }

    public function logout()
    {
        session_destroy();
        header("Location: index.php?page=login");
        exit();
    }
}
