<?php
ob_start();
?>
<div class="wrapper">
  <section class="fancy-bg">
      <div class="container">
        <div class="gear">
          <!-- SVG Gear Shape -->
          <svg viewBox="0 0 100 100" fill="darkviolet">
            <path d="M78.1 54.5c.1-1.5.2-2.9.2-4.5s-.1-3-.2-4.5l10.7-8.4c.9-.7 1.1-2 .5-2.9l-10-17.3c-.6-1-1.8-1.4-2.8-1l-12.6 5.1a38.3 38.3 0 0 0-7.8-4.5L55.3 3.4a2 2 0 0 0-2-1.4H46.6a2 2 0 0 0-2 1.4l-1.6 13.1a38.3 38.3 0 0 0-7.8 4.5l-12.6-5.1a2 2 0 0 0-2.8 1L10.7 34.2a2 2 0 0 0 .5 2.9l10.7 8.4c-.1 1.5-.2 2.9-.2 4.5s.1 3 .2 4.5l-10.7 8.4c-.9.7-1.1 2-.5 2.9l10 17.3c.6 1 1.8 1.4 2.8 1l12.6-5.1c2.4 1.8 5 3.3 7.8 4.5l1.6 13.1c.1.9 1 1.6 2 1.6h6.6c.9 0 1.8-.7 2-1.6l1.6-13.1a38.3 38.3 0 0 0 7.8-4.5l12.6 5.1c1 .4 2.2 0 2.8-1l10-17.3a2 2 0 0 0-.5-2.9l-10.7-8.4zM50 65a15 15 0 1 1 0-30 15 15 0 0 1 0 30z"/>
          </svg>
        </div>
        <div class="heart"></div>
        <div class="square"></div>
     </div>
    <h1>Connect with kindred spirits <br> And Possibly find Love.</h1>
  </section>
  <section class="form-container">
    <form class="form" method="POST">
      <h2>Sign up</h2>
      <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
      <label for="username">
        Username:
        <input id="username" name="username"><br>
      </label>
      <label for="email">
        Email:
        <input id="email" name="email" type="email" required><br>
      </label>
      </label>
      <label for="password">
        Password:
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
