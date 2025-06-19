<?php

namespace App\Models;

use App\Core\Database;

require_once __DIR__.'./../Core/Database.php';

class Comment
{
    protected \PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function addComment(int $userId, int $postId, string $comment): mixed
    {
        try {
            $sql = 'INSERT INTO comments (user_id, post_id, comment) VALUES (?, ?, ?)';
            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([$userId, $postId, $comment]);
        } catch (\PDOException $e) {
            error_log('Add comment error: '.$e->getMessage());

            return false;
        }
    }

    public function getCommentsByPostId(int $postId): array
    {
        try {
            $sql = 'SELECT comments.*, dating_app_user.username 
                    FROM comments 
                    JOIN dating_app_user ON comments.user_id = dating_app_user.user_id 
                    WHERE comments.post_id = ? 
                    ORDER BY comments.created_at ASC';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$postId]);

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log('Get comments error: '.$e->getMessage());

            return [];
        }
    }

    public function getCommentById($id)
    {
        $sql = 'SELECT * FROM comments WHERE comment_id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function deleteComment(int $commentId): mixed
    {
        try {
            $sql = 'DELETE FROM comments WHERE comment_id = ?';
            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([$commentId]);
        } catch (\PDOException $e) {
            error_log('Delete comment error: '.$e->getMessage());

            return false;
        }
    }
}
