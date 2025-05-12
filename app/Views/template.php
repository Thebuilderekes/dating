<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo isset($pageTitle) ? $pageTitle : 'Default Title'; ?>
    </title>
    <link rel="stylesheet" href="../../app/css/index.css" />
    <link rel="stylesheet" href="../../app/css/signup.css" />
    <link rel="stylesheet" href="../../app/css/profile.css" />

</head>

<body>
    <header>
        <nav>
            <ul>
                <div class="nav-logo-container">
                     <li><a href="/"><?php echo isset($logo) ? $logo : ' '; ?></a></li>
                </div>
                 <div class="nav-link flex-center">
                <li><a href=""><?php echo isset($userName) ? $userName : ''; ?></a></li>
                <li><a href=""><?php echo isset($logoutUrl) ? $logoutUrl : ''; ?></a></li>
                <li> <a class="flex-center" href="/profile"><?php echo isset($user) ? "<div class='img-placeholder'></div>" . $user : ' ';?></a></li>
                <li ><a class="btn" href="/<?php echo isset($page) ? $page : ' '?>"><?php echo isset($btn) ? $btn : ' '; ?></a></li>
                </div>
            </ul>
        </nav>
    </header>
    <main>
        <?= $content ?>
    </main>
 <?php include "footer.php"?>
</body>
</html>
