<?php

namespace App\View;

$error = $error ?? '';
ob_start();
?>

<div class="login-section-wrapper wrapper">
  <section class="fancy-bg">
    <h1>Wecome Back</h1>
  </section>
  <section class="form-container">
    <form class="form" method="POST">
      <h2 class="form-heading">Login</h2>
      <?php if (! empty($error)) {
          echo "<p class='error'>$error</p>";
      } ?>
      <label for="name">
        Username
        <input id="name" name="username"><br>
      </label>
      <label for="password">
        Password
        <input name="password" id="password" type="password"><br>
      </label>
      <div class="submit-btn-container">
        <button class="btn" type="submit" id="submit">Login</button>
      </div>

      <p class="have-account">Dont have an account? <a href="/signup">signup</a> </p>
    </form>
</div>
<?php
return ob_get_clean();
