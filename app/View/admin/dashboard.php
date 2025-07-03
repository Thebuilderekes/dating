<?php

namespace App\View\admin;

ob_start();
$users = $users ?? '';
?>
<section>
  <h1>Admin Panel</h1>
  <a class="logout_btn" href="/admin_logout">Logout</a>

<!-- filter users by characters search input --->
<input type="text" id="searchInput" placeholder="Search users..." >
<p id="noResults" class="error">No users match your search.</p>

  <?php if (is_array($users) && ! empty($users)) { ?>
    <table id ="myTab">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u) { ?>
          <tr>
            <td><?= htmlspecialchars($u['user_id']) ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td>
              <?php if ($u['user_id'] != $_SESSION['user_id']) { ?>
                <form method="POST" onsubmit="return confirm('Delete this user?');">
                  <input type="hidden" name="delete_id" value="<?= $u['user_id'] ?>">
                  <button type="submit">Delete</button>
                </form>
              <?php } else { ?> (Admin) <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } elseif ($users === false) { ?>
    <p class="error">Error loading users. Please try again later.</p>
  <?php } else { ?>
    <p>No users found.</p>
  <?php } ?>
</section>
<?php
return ob_get_clean();
?>
