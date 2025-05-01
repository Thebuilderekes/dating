<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Meetand - Register</title>
  <link rel="stylesheet" href="../../app/css/index.css" />
</head>

<body>
  <main>

    <div class="fancy-bg">
      <h1>Meet Like Minds, <br> And Maybe Fall In Love.<h1>
    </div>
    <section class="form-container">
      <form class="form" method="POST">
        <h2>Register</h2>
        <?php if (!empty($error)) echo "<p>$error</p>"; ?>
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
          <button class="btn" type="submit" id="submit">Register</button>
        </div>
        <p class="have-account">Already have an account? <a href="/login">Login</a></p>
      </form>
    </section>
  </main>
</body>

