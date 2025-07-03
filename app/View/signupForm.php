<?php

namespace App\View;

$error = $error ?? '';
ob_start();
?>
<div class="wrapper">
  <section class="fancy-bg">
      <div class="container">
        <div class="gear">
          <img src="./app/assets/gear-70.png" alt="gear icon"/>
        </div>
        <div class="heart"></div>
        <div class="square"></div>
     </div>
    <h1>Connect with kindred spirits <br> Build Relationships.</h1>
  </section>
  <section class="form-container">
    <form class="form" method="POST">
      <h2 class="form-heading">Sign up</h2>
      <?php if (! empty($error)) {
          echo "<p class='error'>$error</p>";
      } ?>
      <label for="username">
        Username
        <input id="username" name="username"><br>
      </label>
      <label for="email">
        Email
        <input id="email" name="email" type="email" required><br>
      </label>
      </label>
      <label for="password">
        Password
        <input name="password" id="password" type="password"><br>
      </label>

      <div class="submit-btn-container">
        <button class="btn" type="submit" id="submit">Sign up</button>
      </div>
      <p class="have-account">Already have an account? <a href="/login">Login</a></p>

    </form>
  </section>
</div>
<?php
return ob_get_clean();
