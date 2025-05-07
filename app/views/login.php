<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Meetand</title>
  <link rel="stylesheet" href="../../app/css/index.css" />

</head>

<body>


  <main>
    <section class="fancy-bg">
      <h1>Wecome Back<h1>
    </section>
    <section class="form-container">
      <form class="form" method="POST">
        <h2>Login</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <label for="name">
          Username:
          <input id="name" name="username"><br>
        </label>
        <label for="password">
          Password:
          <input name="password" id="password" type="password"><br>
        </label>
        <div class="submit-btn-container">
          <button class="btn" type="submit" id="submit">Login</button>
        </div>
        
        <p>Dont have an account? <a href="/register">Register</a> </p>
      </form>
    </section>


  </main>
</body>

</html>
