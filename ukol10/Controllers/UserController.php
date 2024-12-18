<?php

class UsersController
{
    public function index()
    {
        $users = User::getAllUsers();
        
        include 'views/users.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newUser = [
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'is_admin' => isset($_POST['is_admin']) ? 1 : 0
            ];

            User::createUser($newUser);
            header('Location: index.php?page=users');
            exit();
        }

        include 'views/user_create.php';
    }


    public function users_edit($id)
    {

        $user = User::findById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $updatedUser = [
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'is_admin' => isset($_POST['is_admin']) ? 1 : 0
            ];

            User::updateUser($id, $updatedUser);
            header('Location: index.php?page=users');
            exit();
        }

        include 'views/user_edit.php';
    }


    public function delete($id)
    {
        User::deleteUser($id);
        header('Location: index.php?page=users');
        exit();
    }
}