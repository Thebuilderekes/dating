<?php
namespace App\Models;
use App\Core\Database;
//require_once __DIR__ . '/../Core/Database.php';

class Admin

{
    protected \PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function getAllUsers(): mixed
    {
        try {
            $stmt = $this->pdo->prepare("SELECT user_id, username, email FROM dating_app_user");
            if ($stmt->execute()) { // Check if execute is successful
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
            return false; // Return false if execution fails
        } catch (\PDOException $e) {
            error_log("Get all users error: " . $e->getMessage());
            return false;
        }
    }


    public function deleteUserById(int $id): mixed
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

}

