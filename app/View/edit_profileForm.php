<?php

namespace App\View;

$user = $user ?? '';
ob_start();

$user = $user ?? '';
?>
<section class="edit-form-wrapper">
    <h2 class="edit-form-heading">Edit Profile</h2>
<form class="form edit-form" method="POST">
     <label for="bio"> About me </label>
     <textarea rows="10" cols="50" name="bio" ><?= htmlspecialchars(isset($user['bio']) ? $user['bio'] : ' ') ?></textarea><br>
      <button class="save-btn" type="submit">Save</button>
</form>
</section>
<?php
return ob_get_clean();
