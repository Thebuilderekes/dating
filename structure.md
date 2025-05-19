## create ability to add add posts and comments to a timeline

Great question!

Where you place your **controller logic** (the "basic usage") depends on your app's structure. Based on your current PHP setup (namespaces, models, etc.), it looks like you're building a custom MVC framework or something close to it.

Here’s how you can **organize the controller logic** cleanly:

---

## ✅ Recommended Structure

```
project-root/
│
├── App/
│   ├── Core/               # Core system (router, base controller, database)
│   ├── Models/             # Your models (User.php, Post.php, Comment.php)
│   └── Controllers/        # Controller classes (HomeController.php, PostController.php, etc.)
│
├── public/                 # Public entry point (index.php)
│   └── timeline.php        # Timeline view logic
│
├── views/                  # HTML templates / pages
│   └── timeline.php        # Timeline display
│
└── routes/                 # (Optional) Your route definitions
```

---

## 🧠 How to Use Controllers

### 1. **Create a `PostController.php`**

`App/Controllers/PostController.php`

```php
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
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
            $this->postModel->createPost($_SESSION['user_id'], $_POST['content']);
            header("Location: /timeline.php");
            exit;
        }
    }

    public function showTimeline()
    {
        $posts = $this->postModel->getAllPosts();
        include __DIR__ . '/../../views/timeline.php'; // Loads HTML view
    }

    public function addComment()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'], $_POST['post_id'])) {
            $this->commentModel->addComment($_SESSION['user_id'], $_POST['post_id'], $_POST['comment']);
            header("Location: /timeline.php");
            exit;
        }
    }
}
```

---

### 2. **In Your Public `timeline.php` File**

`public/timeline.php`

```php
<?php
require_once __DIR__ . '/../App/Controllers/PostController.php';

use App\Controllers\PostController;

$controller = new PostController();
$controller->showTimeline();
```

---

### 3. **In Your HTML View (`views/timeline.php`)**

```php
<h2>Timeline</h2>

<form method="POST" action="/create_post.php">
    <textarea name="content" required></textarea>
    <button type="submit">Post</button>
</form>

<?php foreach ($posts as $post): ?>
    <div>
        <h4><?= htmlspecialchars($post['username']) ?></h4>
        <p><?= htmlspecialchars($post['content']) ?></p>
        <small><?= $post['created_at'] ?></small>

        <form method="POST" action="/add_comment.php">
            <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
            <input type="text" name="comment" placeholder="Add a comment..." required>
            <button type="submit">Comment</button>
        </form>

        <?php
            $comments = (new \App\Models\Comment())->getCommentsByPostId($post['post_id']);
            foreach ($comments as $comment):
        ?>
            <div style="margin-left:20px;">
                <strong><?= htmlspecialchars($comment['username']) ?></strong>: 
                <?= htmlspecialchars($comment['comment']) ?> <br>
                <small><?= $comment['created_at'] ?></small>
            </div>
        <?php endforeach; ?>
    </div>
    <hr>
<?php endforeach; ?>
```

---

### 4. **Controller Routes (`public/create_post.php` and `public/add_comment.php`)**

These files are thin wrappers to call controller methods:

#### `create_post.php`

```php
<?php
require_once __DIR__ . '/../App/Controllers/PostController.php';

$controller = new \App\Controllers\PostController();
$controller->createPost();
```

#### `add_comment.php`

```php
<?php
require_once __DIR__ . '/../App/Controllers/PostController.php';

$controller = new \App\Controllers\PostController();
$controller->addComment();
```

---

## 🧩 Summary

| File                    | Purpose                          |
| ----------------------- | -------------------------------- |
| `PostController.php`    | Handles post/comment logic       |
| `timeline.php` (view)   | Renders the timeline UI          |
| `create_post.php`       | Handles post creation requests   |
| `add_comment.php`       | Handles new comment submissions  |
| `timeline.php` (public) | Loads controller, shows timeline |

Would you like help generating these files automatically or want a version of this setup with routing support (like a mini Laravel-style router)?
