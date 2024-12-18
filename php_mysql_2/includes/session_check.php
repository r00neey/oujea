<?php
//session_start(); // Spuštění session

// Ověření, zda je uživatel přihlášen
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: index"); // Přesměrování na přihlašovací stránku
    exit();
}
