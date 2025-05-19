<?php
Namespace App\Views;

$timeline = include 'timeline.php';
ob_start();
?>
<div class="page-wrapper">
  <section class="profile-container">
    <h2>Welcome, <?= htmlspecialchars($user['username'] ?? 'Guest') ?></h2>
    <h3>
    <?php
      if(isset($user['first_name']) &&  isset($user['last_name'])){
      echo '<strong>' . 'Name: ' . htmlspecialchars($user["first_name"]) . " " .  htmlspecialchars($user["last_name"]) . '</strong> '; 
      }else{ 
      echo '' ;
      }
    ?>
    </h3>
      <p class="bio"><?= htmlspecialchars(!empty($user['bio']) ? $user['bio'] : 'Click "edit profile" to start editing your profile.') ?>
      </p>
    <a class="btn edit-btn" href="/edit-profile">Edit your Profile</a>
 </section>
 <section class="posts">
   <input type="color"/>
    <?=$timeline?>
</section>
</div>

<?php
return ob_get_clean(); 
?>
