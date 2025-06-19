<?php

namespace App\View;

$user = $user ?? '';
$adSection = include 'ads.view.php';
$timeline = include 'timeline.view.php';
ob_start();
?>
<div class="home-wrapper">
   <?= $adSection?>
    <?= $timeline?>
  <section class="side-nav" id="side-nav" aria-hidden="true" >
 <nav>
   <button id="closeMenuBtn" aria-controls="side-nav" aria-expanded="false">[Close menu]</button>
</nav>
<div class="side-nav-details">
    <h2>Welcome, <?= htmlspecialchars($user['username'] ?? 'Guest') ?></h2>
      <h3>About</h3>
      <p class="bio"><?= htmlspecialchars(! empty($user['bio']) ? $user['bio'] : 'Click "edit profile" button to start editing your profile.') ?>
      </p>
    <a class="btn edit-btn" href="/edit_bio">Edit Your Bio</a>
 </section>
</div>
</div>

<?php
return ob_get_clean();
?>
