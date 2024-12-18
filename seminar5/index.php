<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'controllers/LoginController.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/ItemsController.php';
require_once 'controllers/UsersController.php';
require_once 'controllers/HeaderController.php';
require_once 'controllers/OthersController.php';
include 'Models/User.php';
require_once 'db.php';



User::setConnection($conn);

$isLoggedIn = isset($_SESSION['user_id']);

if (isset($_GET['page']) && $_GET['page'] === 'logout') {
    $loginController = new LoginController();
    $loginController->logout();
    exit();
}

$page = $_GET['page'] ?? 'login';
$controller = null;

if ($isLoggedIn) {
    $controllerHeader = new HeaderController();
    $controllerHeader->index();
    switch ($page) {
        case 'dashboard':
            $controller = new DashboardController();
            $controller->index();
            break;
        case 'items':
            $controller = new ItemsController();
            $controller->index();
            break;
        case 'users':
            $controller = new UsersController();
            $controller->index();
            break;
        case 'others':
            $controller = new OthersController();
            $controller->index();
            break;
        case 'user_create':
            $controller = new UsersController();
            $controller->create();
            break;
        case 'edit_user':
            $controller = new UsersController();
            $controller->users_edit();
            break;
        case 'user_delete':
            $controller = new UsersController();
            $controller->delete($_GET['id']);
            break;
        default:
            echo $page;
            echo $isLoggedIn;
            include 'views/error.php';
            break;
    }
} else {
    $controller = new LoginController();
    $controller->login();
}

if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']);
}
