<?php
namespace App\Views;
use App\Controllers\PostController;
$postController = new PostController();
$posts = $postController->showTimeline();
ob_start();
?>
<h2>Timeline</h2>

<form method="POST" action="/create_post">
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
<?php
 return ob_get_clean();             
