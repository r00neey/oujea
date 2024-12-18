<?php

class UsersController
{
    public function index()
    {
        include 'views/users.php';
    }

    public function users_edit()
    {
        include 'edit_user.php';
    }

}
