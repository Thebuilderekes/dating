<!DOCTYPE html>
<html>

<head>
  <title>Admin Login</title>
</head>

<body>
  <h2>Admin Login</h2>
  <?php if (!empty($error)): ?><p style="color:red"><?= htmlspecialchars($error) ?></p><?php endif; ?>
  <form method="POST">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit">Login</button>
  </form>
</body>

</html>
