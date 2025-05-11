<?php
Namespace App\Views;
ob_start();
?>
<section class="profile-container">
  <h2>Welcome, <?= htmlspecialchars($user['username'] ?? 'Guest') ?></h2>
<h3>
<?php
  if(isset($user['first_name']) &&  isset($user['last_name'])){
  echo '<strong>' . htmlspecialchars($user["first_name"]) . " " .  htmlspecialchars($user["last_name"]) . '</strong> '; 
  }else{ 
  echo '' ;
  }
?>
</h3>
  <p><strong>Bio:</strong> <span class="bio"><?= htmlspecialchars($user['bio'] ?? 'Click "edit profile" to start editing your profile.') ?></span></p>
  <a class="btn edit-btn" href="/edit-profile">Edit your Profile</a>
</section>
<?php
return ob_get_clean(); 
?>
