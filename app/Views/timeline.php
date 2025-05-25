<?php
use App\Helpers\DateTimeHelper;
use App\Controllers\PostController;
$postController = new PostController();
$posts = $postController->getAllPosts();
$DateTime = new DateTimeHelper();

ob_start();
?>
<section class="timeline-wrapper">
  <form method="POST" aria-labelledby="create-post-heading" action="/create_post" class="create-post-form">
    <h2 id="create-post-heading">Create post</h2>
    <textarea placeholder="Say something..." rows="3" cols="30" name="content" required></textarea>
    <button class="create-post-btn btn" type="submit">Post</button>
  </form>

  <?php foreach ($posts as $post): ?>
    <?php
      $timeOfPost = $DateTime->timeAgo($post['created_at']);
      $comments = (new \App\Models\Comment())->getCommentsByPostId($post['post_id']);
?>
    <article class="post-wrapper flex-col" aria-labelledby="post-title-<?= $post['post_id'] ?>">
      <header>
        <h3 id="post-title-<?= $post['post_id'] ?>"><?= htmlspecialchars($post['username']) ?></h3>
        <small>
          <time datetime="<?= htmlspecialchars($post['created_at']) ?>"><?= $timeOfPost ?></time>
        </small>
      </header>
        <p><?= htmlspecialchars($post['content']) ?></p>
      <button type="button" class="toggle-comment-btn" data-target="#comment-form"
  aria-expanded="false" class="toggle-comment-btn" data-post-id="<?= $post['post_id'] ?>">💬</button>
      <div class="comment-form" id="comment-form" hidden>
        <form method="POST" action="/add_comment" class="comment-form-element">
          <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
          <textarea type="text" rows="2" cols="20" name="comment" placeholder="Add a comment..." required></textarea>
          <button class="post-comment-btn" type="submit">Add comment</button>
        </form>
      </div>
    </article>
      <?php if (!empty($comments)): ?>
        <details>
          <summary>View comments (<?= count($comments) ?>)</summary>
          <ul class="comments_list">
            <?php foreach ($comments as $comment): ?>
              <li>
                <article class="comment-wrapper flex-col" aria-labelledby="comment-author-<?= $comment['comment_id'] ?>">
                  <header>
                      <h4><strong><?= htmlspecialchars($comment['username']) ?></strong> </h4>
                    <small>
                       <time datetime="<?= htmlspecialchars($comment['created_at']) ?>">
                        <?= $DateTime->timeAgo($comment['created_at']) ?>
                      </time>
                    </small>
                  </header>
                    <p><?= htmlspecialchars($comment['comment']) ?></p>
                </article>
              </li>
            <?php endforeach; ?>
          </ul>
        </details>
      <?php endif; ?>
  <?php endforeach; ?>
</section>

<?php
return ob_get_clean();

