<?php
Namespace App\Controllers;
use App\Core\Controller;
use App\Models\User;
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../Core/Controller.php";

class UserController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if ($this->userModel->login($_POST['username'], $_POST['password'])) {
                    header("Location: /profile");
                    exit;
                } else {
                    $this->view('login', ['error' => 'Wrong username or password']);
                    return $user;
                }
            } catch (\Exception $e) {
                $this->view('login', ['error' => 'An error occurred: ' . $e->getMessage()]);
            }
        } else {
            $this->view('login');
        }
    }


    public function signUp()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Simple validation
                if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
                    $this->view('signUp', ['error' => 'All fields are required.']);
                    return;
                }

                $success = $this->userModel->signUp($_POST['username'], $_POST['email'], $_POST['password']);
                if ($success) {
                    header("Location: /login");
                    exit;
                } else {
                $this->view('signUp', ['error' =>"This username/email is already taken"]);
                }
            } catch (\Exception) {
                $this->view('signUp', ['error' =>"This username/email is already taken"]);
            }
        } else {
            $this->view('signUp');
        }
    }

    public function editProfile()
    {

        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->userModel->updateProfile(
                    $_SESSION['user_id'],
                    $_POST['bio']
                );
                header("Location: /profile");
                exit;
            }

            $user = $this->userModel->getUserById($_SESSION['user_id']);
            $this->view('edit_profile', ['user' => $user]);
        } catch (\Exception $e) {
            $this->view('edit_profile', ['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function profile()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $this->view('profile', ['user' => $user]);
    }

    public function deleteUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $userId = $_POST['delete_id'];

            try {
                $this->userModel->deleteUserById($userId);
                header("Location: /admin_dashboard"); // or wherever your dashboard is
                exit;
            } catch (\Exception $e) {
                $this->view('admin/dashboard', ['error' => 'Failed to delete user: ' . $e->getMessage()]);
            }
        } else {
            header("Location: index.php?page=admin_dashboard");
        }
    }


    public function logout()
    {
        session_destroy();
        header("Location: /login");
    }
}
