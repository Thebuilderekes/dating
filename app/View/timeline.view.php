<?php

namespace App\View;

use App\Controllers\PostController;
use App\Helpers\DateTimeHelper;
use App\Models\Comment;

$commentObj = new Comment;
$postController = new PostController;
$posts = $postController->getAllPosts();
$DateTime = new DateTimeHelper;

ob_start();
?>

<section class="timeline-wrapper">
  <form method="POST" aria-labelledby="create-post-heading" action="/create_post" class="create-post-form">
    <h2 id="create-post-heading">Create post</h2>
    <textarea placeholder="Say something..." rows="3" cols="30" name="content" required></textarea>
    <button class="create-post-btn btn" type="submit">Post</button>
  </form>
<div class="timeline">
  <?php foreach ($posts as $post) { ?>
    <?php
      $timeOfPost = $DateTime->timeAgo($post['created_at']);
      $comments = $commentObj->getCommentsByPostId($post['post_id']);
      ?>
    <article class="post-wrapper user-article" aria-labelledby="post-title-<?= $post['post_id'] ?>">
      <header>
        <h3 id="post-title-<?= $post['post_id'] ?>"><?= htmlspecialchars($post['username']) ?></h3>
        <small>
          <time datetime="<?= htmlspecialchars($post['created_at']) ?>"><?= $timeOfPost ?></time>
        </small>
      </header>
        <p><?= htmlspecialchars($post['content']) ?></p>
      <div class="engagement-wrapper flex-center">
        <button type="button" class="make-comment-btn" data-target="#comment-form-<?= $post['post_id'] ?>"
        aria-expanded="false" data-post-id="<?= $post['post_id'] ?>">Comment</button>
          <?php if ($_SESSION['user_id'] === $post['user_id']) { ?>
          <div class="form-delete-btn-wrapper flex-center">
              <form method="POST" action="/delete_post">
                 <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                  <button class="delete-btn" type="submit" onclick="return confirm('Delete this post?');">Delete Post</button>
             </form>
           </div>
        <?php }?>
      </div>
      <div class="comment-form" id="comment-form-<?= $post['post_id'] ?>" hidden>
        <form method="POST" action="/add_comment" class="comment-form-element">
          <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
          <textarea type="text" rows="2" cols/="20" name="comment" placeholder="Write a comment..." required></textarea>
          <button class="post-comment-btn" type="submit">send</button>
        </form>
      </div>
    </article>
      <?php if (! empty($comments)) { ?>
        <details>
          <summary>View comments (<?= count($comments) ?>)</summary>
          <ul class="comments_list">
            <?php foreach ($comments as $comment) { ?>
              <li>
                <article class="comment-wrapper user-article" aria-labelledby="comment-author-<?= $comment['comment_id'] ?>">

                  <header>
                      <h4><strong><?= htmlspecialchars($comment['username']) ?></strong> </h4>
                    <small>
                       <time datetime="<?= htmlspecialchars($comment['created_at']) ?>">
                        <?= $DateTime->timeAgo($comment['created_at']) ?>
                      </time>
                    </small>
                  </header>
                    <p><?= htmlspecialchars($comment['comment']) ?></p>
                   <?php if ($_SESSION['user_id'] === $comment['user_id']) {  ?>
                     <form method="POST" action="/delete_comment">
                        <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
                        <button type="submit" onclick="return confirm('Delete this comment?')">Delete Comment</button>
                      </form>
                  <?php } ?>
                </article>
              </li>
            <?php } ?>
          </ul>
        </details>
      <?php } ?>
  <?php } ?>
</div>
</section>

<?php
return ob_get_clean();
