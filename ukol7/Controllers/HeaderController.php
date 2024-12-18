<?php

class HeaderController
{
    public function index()
    {
        include 'views/header.php';
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();

        header("Location: index.php");
        exit();
    }
}