<?php
use App\Controllers\UserController;
use App\Controllers\AdminController;
use App\Controllers\PostController;

$uri = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '/';
$userController = new UserController();
$adminController = new AdminController();
$postController = new PostController();
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
    case '/logout':
        $userController->logout();
        break;
    case '/signUp':
        $userController->signUp();
        break;
    case '/home':
        $userController->home();
        $postController->getAllPosts();
        break;
    case '/edit_bio':
        $userController->editProfile();
        break;
    case '/create_post':
        $postController->createPost();
        break;
    case '/delete_post':
        $postController->deletePost();
        break;
    case '/add_comment':
        $postController->addComment();
        break;
    case '/delete_comment':
        $postController->deleteComment();
        break;
    default:
        echo "404 Not Found"; // controller->404();
}


