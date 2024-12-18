<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $office = $_POST['office'];
    $description = $_POST['description'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash hesla
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $sql = "INSERT INTO users (first_name, last_name, email, phone, office, description, password, is_admin) 
            VALUES ('$first_name', '$last_name', '$email', '$phone', '$office', '$description', '$password', '$is_admin')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?page=users");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
