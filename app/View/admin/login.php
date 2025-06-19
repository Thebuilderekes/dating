<?php

namespace App\View\admin;

ob_start();
?> 
  <?php if (! empty($error)) { ?><p style="color:red"><?= htmlspecialchars($error) ?></p><?php } ?>
<div class="admin-section-wrapper">
<section class="form-container admin-login-form-container"> 
 <h2 class="admin-login-heading">Admin Login</h2>
  <form method="POST"class="form">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button class="btn" type="submit">Login</button>
  </form>
</section>
</div>
<?php
return ob_get_clean();
?>
