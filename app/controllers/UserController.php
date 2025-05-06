<?php
require_once __DIR__ . "./../../session.php";
require_once __DIR__ . "./../models/User.php";
require_once __DIR__ . "./../core/Controller.php";

class UserController extends Controller
{
    private $userModel;

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
                    $this->view('login', ['error' => 'Invalid credentials']);
                    return;
                }
            } catch (Exception $e) {
                $this->view('login', ['error' => 'An error occurred: ' . $e->getMessage()]);
            }
        } else {
            $this->view('login');
        }
    }


    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Simple validation
                if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
                    $this->view('register', ['error' => 'All fields are required.']);
                    return;
                }

                $success = $this->userModel->register($_POST['username'], $_POST['email'], $_POST['password']);
                if ($success) {
                    header("Location: /login");
                    exit;
                } else {
                    $this->view('register', ['error' => 'Registration failed.']);
                }
            } catch (Exception) {
                $this->view('register', ['error' => 'Error: ' . "This username/email is already taken"]);
            }
        } else {
            $this->view('register');
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
                    $_POST['first_name'],
                    $_POST['last_name'],
                    $_POST['bio']
                );
                header("Location: /profile");
                exit;
            }

            $user = $this->userModel->getUserById($_SESSION['user_id']);
            $this->view('edit_profile', ['user' => $user]);
        } catch (Exception $e) {
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



    public function logout()
    {
        session_destroy();
        header("Location: /login");
    }
}
