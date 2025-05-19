<?php
namespace App\Controllers;

use App\Models\Post;
use App\Models\Comment;

class PostController
{
    protected Post $postModel;
    protected Comment $commentModel;

    public function __construct()
    {
        $this->postModel = new Post();
        $this->commentModel = new Comment();
    }

    public function createPost()
    {
        //session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
          $success = $this->postModel->createPost($_SESSION['user_id'], $_POST['content']);
          if($success){
            header("Location: /profile");
            exit;
          } 
        }
    }

    public function showTimeline()
    {
        $posts = $this->postModel->getAllPosts();
        return $posts;
        include __DIR__ . '/../Views/timeline.php'; // Loads HTML view
    }

    public function addComment()
    {
       // session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'], $_POST['post_id'])) {
            $this->commentModel->addComment($_SESSION['user_id'], $_POST['post_id'], $_POST['comment']);
            header("Location: /profile.php");
            exit;
        }
    }
}
