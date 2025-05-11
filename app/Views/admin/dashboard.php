<!DOCTYPE html>
<html>

<head>
  <title>Admin Dashboard</title>
  <style>

    body {
      padding: 0 20px;
    }
    .logout_btn {
      text-decoration: none;
      padding: 8px 10px;
      margin-bottom: 15px;
      font-size: 20px;
      display: inline-block;
      background-color: red;
      color: white;
    }

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
  table tr:nth-child(even) {
      background-color: #f2f2f2; /* Grey for odd rows */
    }
    .error {
      color: red;
      font-weight: 600;
    }

    #searchInput {
      display: block;
      margin-bottom: 10px; 
      padding: 8px;
    }

    #noResults {
      display: none;
    }
  </style>
</head>

<body>
  <h1>Admin Panel</h1>
  <a class="logout_btn" href="/admin_login">Logout</a>
<input type="text" id="searchInput" placeholder="Search users..." >
<p id="noResults" class="error">No users match your search.</p>

  <?php if (is_array($users) && !empty($users)): ?>
    <table id ="myTabv">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u): ?>
          <tr>
            <td><?= htmlspecialchars($u['user_id']) ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td>
              <?php if ($u['user_id'] != $_SESSION['user_id']): ?>
                <form method="POST" onsubmit="return confirm('Delete this user?');">
                  <input type="hidden" name="delete_id" value="<?= $u['user_id'] ?>">
                  <button type="submit">Delete</button>
                </form>
              <?php else: ?> (Admin) <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php elseif ($users === false): ?>
    <p class="error">Error loading users. Please try again later.</p>
  <?php else: ?>
    <p>No users found.</p>
  <?php endif; ?>
<script>
  const searchInput = document.getElementById('searchInput');
  const noResults = document.getElementById('noResults');

  searchInput.addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');

    let visibleCount = 0;
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      const isMatch = text.includes(filter);
      row.style.display = isMatch ? '' : 'none';
      if (isMatch) visibleCount++;
    });

    // Show or hide the "No users" message
    noResults.style.display = visibleCount === 0 ? 'block' : 'none';
  });
</script>

</body>

</html>
