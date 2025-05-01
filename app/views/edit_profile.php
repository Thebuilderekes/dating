<form method="POST" id="edit_profile_form">
    <h2>Edit Profile</h2>
    <label for="first_name">
    First Name: 
    <input name="first_name" id="first_name" value="<?= htmlspecialchars($user['first_name'] ?? '')  ?>"><br>
    </label>
    <label for="last_name">
    Last Name: <input name="last_name" id="last_name" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>"><br>
    </label>
    Bio: <textarea name="bio"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea><br>
    <button type="submit">Save</button>
</form>
