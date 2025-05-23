<?php
use App\Controllers\PostController;
use App\Helpers\DateTimeHelper;

$postController = new PostController();
$posts = $postController->getAllPosts();
$DateTime = new DateTimeHelper();

ob_start();
?>
<section class="timeline-wrapper">
  <form method="POST" action="/create_post">
    <h2>Create post</h2>
    <textarea placeholder="Say something" rows="5" cols="40" name="content" required></textarea>
    <button class="post-btn btn" type="submit">Post</button>
  </form>

  <?php foreach ($posts as $post): ?>
    <?php
      $timeOfPost = $DateTime->timeAgo($post['created_at']);
      $comments = (new \App\Models\Comment())->getCommentsByPostId($post['post_id']);
    ?>
    <article class="post-wrapper" aria-labelledby="post-title-<?= $post['post_id'] ?>">
      <header>
        <h3 id="post-title-<?= $post['post_id'] ?>"><?= htmlspecialchars($post['username']) ?></h3>
      </header>
        <p><?= htmlspecialchars($post['content']) ?></p>
        <small>
          <time datetime="<?= htmlspecialchars($post['created_at']) ?>"><?= $timeOfPost ?></time>
        </small>

      <form method="POST" action="/add_comment">
        <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
        <input type="text" name="comment" placeholder="Add a comment..." required>
        <button type="submit">Comment</button>
      </form>

      <?php if (!empty($comments)): ?>
        <details>
          <summary>View comments (<?= count($comments) ?>)</summary>
          <ul>
            <?php foreach ($comments as $comment): ?>
              <li>
                <article class="comment-wrapper" aria-labelledby="comment-author-<?= $comment['comment_id'] ?>">
                  <header>
                    <div id="comment-author">
                      <h4><strong><?= htmlspecialchars($comment['username']) ?></strong> </h4>
                    <p><?= htmlspecialchars($comment['comment']) ?></p>
                    <small>
                       <time datetime="<?= htmlspecialchars($comment['created_at']) ?>">
                        <?= $DateTime->timeAgo($comment['created_at']) ?>
                      </time>
                    </small>
                    </div>
                  </header>
                </article>
              </li>
            <?php endforeach; ?>
          </ul>
        </details>
      <?php endif; ?>
    </article>
  <?php endforeach; ?>
</section>

<?php
return ob_get_clean();

