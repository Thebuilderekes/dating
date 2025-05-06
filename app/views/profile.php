<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Game Scores</title>
    <link rel="stylesheet" href="../../app/css/index.css" />
    <link rel="stylesheet" href="../../app/css/profile.css" />

</head>

<body>
    <main>
        <section class="container">
            <h2>Welcome, <?= htmlspecialchars($user['username'] ?? 'Guest') ?></h2>
            <p><strong>Name:</strong> <?= htmlspecialchars($user['first_name'] ?? '') ?> <?= htmlspecialchars($user['last_name'] ?? '') ?></p>
            <p><strong>Bio:</strong> <span class="bio"><?= htmlspecialchars($user['bio'] ?? 'This user has no bio yet.') ?></span></p>
            <a class="btn edit-btn" href="/edit-profile">Edit Profile</a>
            <a class="btn logout-btn" href="/logout">Logout</a>
        </section>
    </main>
</body>

</html>
