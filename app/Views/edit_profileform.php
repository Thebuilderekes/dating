<?php
Namespace App\Views;
ob_start();

?>
<section class="edit-form-wrapper">
    <h2 class="edit-form-heading">Edit Profile</h2>
<form class="form edit-form" method="POST">
    <label for="first_name">  First Name: </label> 
     <input name="first_name" value="<?= htmlspecialchars(isset($user['first_name']) ? $user['first_name'] : " " ) ?>"><br>
     <label for="last_name"> Last Name </label>
     <input name="last_name" value="<?= htmlspecialchars(isset($user['last_name']) ? $user['last_name'] : " " ) ?>"><br>
     <label for="bio"> Bio </label>
     <textarea rows="10" cols="50" name="bio" ><?= htmlspecialchars(isset($user['bio']) ? $user['bio'] : " " ) ?></textarea><br>
      <button class="save-btn" type="submit">Save</button>
</form>
</section>
<?php
return ob_get_clean(); 
