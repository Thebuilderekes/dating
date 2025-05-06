<?php
require_once __DIR__ . "/../../session.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../core/Controller.php";

class AdminController extends Controller
{
  private $userModel;

  public function __construct()
  {
    $this->userModel = new User();
  }
public function login()
{
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
      $this->view('admin/login', ['error' => 'Username and password are required.']);
      return;
    }

    try {
      $user = $this->userModel->login($username, $password);
      if ($user && $user['is_admin']) {
        $_SESSION['user_id'] = $user['user_id'];
        header("Location: /admin_dashboard");
        exit;
      } else {
        $this->view('admin/login', ['error' => 'Access denied. Admins only.']);
      }
    } catch (Exception $e) {
      $this->view('admin/login', ['error' => 'An error occurred: ' . $e->getMessage()]);
    }
  } else {
    $this->view('admin/login');
  }
}


  public function dashboard()
  {
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = (int) $_POST['delete_id'];
    if ($deleteId > 0) {
        $this->userModel->deleteUserById($deleteId);
        header("Location: /admin_dashboard");
        exit;
    }
}

    if (!isset($_SESSION['user_id'])) {
      header("Location: /admin_login");
      exit;
    }

    try {
      $users = $this->userModel->getAllUsers();
      if ($users === false) {
  $users = []; // fallback, so the view only sees arrays
}
      $this->view('admin/dashboard', ['users' => $users]);
    } catch (Exception $e) {
      $this->view('admin/dashboard', ['error' => 'Failed to load users: ' . $e->getMessage()]);
    }





  }

  public function deleteUser($id)
  {
    if (!isset($_SESSION['user_id'])) {
      header("Location: /login");
      exit;
    }

    try {
      $this->userModel->deleteUserById($id);
      header("Location: /admin/dashboard");
    } catch (Exception $e) {
      $this->view('admin/dashboard', ['error' => 'Error deleting user: ' . $e->getMessage()]);
    }
  }

  public function logout()
  {
    session_destroy();
    header("Location: /admin/login");
  }
}
