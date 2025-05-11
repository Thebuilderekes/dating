<?php
use App\Controllers\UserController;
use App\Controllers\AdminController;

$uri = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '/';
$userController = new UserController();
$adminController = new AdminController();
switch ($uri) {
    case '/':
        $userController->signUp();
        break;
    case '/admin_login':
        $adminController->login();
        break;
    case '/admin_dashboard':
        $adminController->dashboard();
        break;
    case '/admin_logout':
        $adminController->logout();
        break;
    case '/login':
        $userController->login();
        break;
    case '/signUp':
        $userController->signUp();
        break;
    case '/profile':
        $userController->profile();
        break;
    case '/edit-profile':
        $userController->editProfile();
        break;
    case '/logout':
        $userController->logout();
        break;
    default:
        echo "404 Not Found"; // controller->404();
}


