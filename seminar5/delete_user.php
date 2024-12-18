<?php
include 'db.php';
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: index.php?page=users");
    exit();
}

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $sql = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?page=users");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "No user ID provided.";
}

$conn->close();
?>