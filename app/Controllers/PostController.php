<?php
namespace App\Controllers;
use App\Models\Post;
use App\Models\Comment;
require_once __DIR__ . "/../../session.php"; //added newly
class PostController
{
    protected Post $postModel;
    protected Comment $commentModel;

    public function __construct()
    {
        $this->postModel = new Post();
        $this->commentModel = new Comment();
    }

    public function createPost(): void
    {
        //session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
          $success = $this->postModel->createPost($_SESSION['user_id'], $_POST['content']);
          if($success){
            header("Location: /home");
            exit;
          } 
        }
    }

    public function getAllPosts():array
    {
        $posts = $this->postModel->getAllPosts();
        return $posts;
    }
    public function deletePost(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
            $post = $this->postModel->getPostById($_POST['post_id']);
            if ($post && $post['user_id'] === $_SESSION['user_id']) {
                $this->postModel->deletePost($_POST['post_id']);
            }
            header("Location: /home");
            exit;
        }
    }

    public function deleteComment(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_id'])) {
            $comment = $this->commentModel->getCommentById($_POST['comment_id']);
            if ($comment && $comment['user_id'] === $_SESSION['user_id']) {
                $this->commentModel->deleteComment($_POST['comment_id']);
            }
            header("Location: /home");
            exit;
        }
    }

    public function addComment(): void
    {
       // session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'], $_POST['post_id'])) {
            $this->commentModel->addComment($_SESSION['user_id'], $_POST['post_id'], $_POST['comment']);
            header("Location: /home");
            exit;
        }
    }
}
