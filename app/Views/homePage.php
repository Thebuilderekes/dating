<?php
Namespace App\Views;
$user = $user ?? '';
$adSection = include 'ads.view.php';
$timeline = include 'timeline.view.php';
ob_start();
?>
<div class="home-wrapper">
   <?=$adSection?>
    <?=$timeline?>
  <section class="edit-profile-section sidebar" id="sidebar" aria-hidden="true" >
 <nav>
   <button id="closeMenuBtn"aria-controls="sidebar" aria-expanded="false">X</button>
</nav>
<div class="edit-profile-section-details">
    <h2>Welcome, <?= htmlspecialchars($user['username'] ?? 'Guest') ?></h2>
      <h3>About</h3>
      <p class="bio"><?= htmlspecialchars(!empty($user['bio']) ? $user['bio'] : 'Click "edit profile" button to start editing your profile.') ?>
      </p>
    <a class="btn edit-btn" href="/edit_bio">Edit Your Bio</a>
<div>
 </section>
</div>

<?php
return ob_get_clean(); 
?>
