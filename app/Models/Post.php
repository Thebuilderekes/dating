<?php
namespace App\Models;
use App\Core\Database;
//require_once __DIR__ . '/../Core/Database.php';

class Post
{
    protected \PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function createPost(int $userId, string $content): mixed
    {
        try {
            $sql = "INSERT INTO posts (user_id, content) VALUES (?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$userId, $content]);
        } catch (\PDOException $e) {
            error_log("Create post error: " . $e->getMessage());
            return false;
        }
    }

    public function getAllPosts(): mixed
    {
        try {
            $sql = "SELECT posts.*, dating_app_user.username 
                    FROM posts 
                    JOIN dating_app_user ON posts.user_id = dating_app_user.user_id 
                    ORDER BY posts.created_at DESC";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Fetch posts error: " . $e->getMessage());
            return [];
        }
    }

    public function getPostById(int $postId): array|false
    {
        try {
            $sql = "SELECT * FROM posts WHERE post_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$postId]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Get post error: " . $e->getMessage());
            return false;
        }
    }

public function deletePost(int $postId): mixed
{
    try {
        $sql = "DELETE FROM posts WHERE post_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$postId]);
    } catch (\PDOException $e) {
        error_log("Delete post error: " . $e->getMessage());
        return false;
    }
}
}
