<?php
Namespace App\Views;

$timeline = include 'timeline.view.php';
ob_start();
?>
<div class="home-wrapper">
  <section class="edit-profile-section">
    <h2>Welcome, <?= htmlspecialchars($user['username'] ?? 'Guest') ?></h2>
      <h3>About</h3>
      <p class="bio"><?= htmlspecialchars(!empty($user['bio']) ? $user['bio'] : 'Click "edit profile" to start editing your profile.') ?>
      </p>
    <a class="btn edit-btn" href="/edit_profile">Edit your Profile</a>
 </section>
    <?=$timeline?>
</div>

<?php
return ob_get_clean(); 
?>
