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
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO dating_app_user (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$username, $email, $hash]);
    }

    public function login(string $username, string $password): bool
    {
        $sql = "SELECT * FROM dating_app_user WHERE username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            return true;
        }

        return false;
    }

    public function getUserById(int $id): array|false
    {
        $sql = "SELECT * FROM dating_app_user WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile(int $id, string $first_name, string $last_name, string $bio): bool
    {
        $sql = "UPDATE dating_app_user SET first_name = ?, last_name = ?, bio = ? WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$first_name, $last_name, $bio, $id]);
    }
}
