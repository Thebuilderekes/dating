<?php
require_once __DIR__ . '/app/controllers/UserController.php';
require_once __DIR__ . '/app/controllers/AdminController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$controller = new UserController();
$adminController = new AdminController();
switch ($uri) {
    case '/':
        $controller->register();
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
        $controller->login();
        break;
    case '/register':
        $controller->register();
        break;
    case '/profile':
        $controller->profile();
        break;
    case '/edit-profile':
        $controller->editProfile();
        break;
    case '/logout':
        $controller->logout();
        break;
    default:
        echo "404 Not Found"; // controller->404();
}
