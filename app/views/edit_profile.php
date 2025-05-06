<form method="POST">
    <h2>Edit Profile</h2>
    First Name: <input name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>"><br>
    Last Name: <input name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>"><br>
    Bio: <textarea name="bio"><?= htmlspecialchars($user['bio']) ?></textarea><br>
    <button type="submit">Save</button>
</form>
