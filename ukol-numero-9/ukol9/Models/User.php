<?php

class User
{
    private static $conn;

    public static function setConnection($connection)
    {
        self::$conn = $connection;
    }

    public static function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public static function updateLastLogin($userId)
    {
        $current_time = date('Y-m-d H:i:s');
        $sql = "UPDATE users SET last_login = ? WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("si", $current_time, $userId);
        $stmt->execute();
    }

    public static function getLastLogin()
    {
        $sql = 'SELECT * FROM users ORDER BY last_login DESC LIMIT 10';
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
    }
}
