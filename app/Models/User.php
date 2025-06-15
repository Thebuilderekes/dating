<?php
Namespace App\Models;
use App\Core\Database;

class User
{
    protected \PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function signUp(string $username, string $email, string $password): mixed
    {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO dating_app_user (username, email, password) VALUES (?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$username, $email, $hash]);
        } catch (\PDOException $e) {
            error_log("signUp error: " . $e->getMessage());
            return false;
        }
    }

    public function login(string $username, string $password): mixed
    {
        try {
            $sql = "SELECT * FROM dating_app_user WHERE username = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$username]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!$user) {
                $error = "Invalid username or password.";
            }
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                $_SESSION['user_id'] = $user['user_id']; // ✅ add this line
                $_SESSION['is_admin'] = $user['is_admin']; // 🟡 Added this recently line on 1st june
                return $user;
            }
        } catch (\PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            return false;
        }
    }
    public function deleteUserById(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM dating_app_user WHERE user_id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (\PDOException $e) {
            error_log("Delete user error: " . $e->getMessage());
            return false;
        }
    }

    public function getUserById(int $id): mixed
    {
        try {
            $sql = "SELECT * FROM dating_app_user WHERE user_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Get user by ID error: " . $e->getMessage());
            return false;
        }
    }

    public function updateProfile(int $id, string $bio): bool
    {
        try {
            $sql = "UPDATE dating_app_user SET bio = ? WHERE user_id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$bio, $id]);
        } catch (\PDOException $e) {
            error_log("Update profile error: " . $e->getMessage());
            return false;
        }
    }
}
