<?php
require_once __DIR__ . '/../core/Database.php';

class User
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function register(string $username, string $email, string $password): bool
    {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO dating_app_user (username, email, password) VALUES (?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$username, $email, $hash]);
        } catch (PDOException $e) {
            error_log("Register error: " . $e->getMessage());
            return false;
        }
    }

    public function login(string $username, string $password)
    {
        try {
            $sql = "SELECT * FROM dating_app_user WHERE username = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$user) {
                    $error = "Invalid username or password.";
                }
            if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $user['user_id']; // ✅ add this line
            return $user;
             }
        } catch (PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            return false;
        }
    }

public function getAllUsers(): array|false
{
    try {
        $stmt = $this->pdo->prepare("SELECT user_id, username, email FROM dating_app_user");
        if ($stmt->execute()) { // Check if execute is successful
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return false; // Return false if execution fails
    } catch (PDOException $e) {
        error_log("Get all users error: " . $e->getMessage());
        return false;
    }
}


    public function deleteUserById(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM dating_app_user WHERE user_id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log("Delete user error: " . $e->getMessage());
            return false;
        }
    }

    public function getUserById(int $id): array|false
    {
        try {
            $sql = "SELECT * FROM dating_app_user WHERE user_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get user by ID error: " . $e->getMessage());
            return false;
        }
    }

    public function updateProfile(int $id, string $first_name, string $last_name, string $bio): bool
    {
        try {
            $sql = "UPDATE dating_app_user SET first_name = ?, last_name = ?, bio = ? WHERE user_id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$first_name, $last_name, $bio, $id]);
        } catch (PDOException $e) {
            error_log("Update profile error: " . $e->getMessage());
            return false;
        }
    }
}
