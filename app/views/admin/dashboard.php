<!DOCTYPE html>
<html>

<head>
  <title>Admin Dashboard</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }
  </style>
</head>

<body>
  <h1>Admin Panel</h1>
  <p><a href="/admin_login">Logout</a></p>

  <?php if (is_array($users) && !empty($users)): ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Bio</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u): ?>
          <tr>
            <td><?= htmlspecialchars($u['user_id']) ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= nl2br(htmlspecialchars($u['bio'] ?? '')) ?></td>
            <td>
              <?php if ($u['user_id'] != $_SESSION['user_id']): ?>
                <form method="POST" onsubmit="return confirm('Delete this user?');">
                  <input type="hidden" name="delete_id" value="<?= $u['user_id'] ?>">
                  <button type="submit">Delete</button>
                </form>
              <?php else: ?> (You) <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php elseif ($users === false): ?>
    <p style="color: red;">Error loading users. Please try again later.</p>
  <?php else: ?>
    <p>No users found.</p>
  <?php endif; ?>
</body>

</html>
