<?php
namespace App\Views;

?>
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
<link rel="stylesheet" href="../../app/css/home.css" />
<link rel="stylesheet" href="../../app/css/admin-login.css" />

</head>

<body class="admin-body">
    <header>
        <nav class="main-nav">
            <ul>
                <div class="nav-logo-container">
                     <li><a href="<?php echo isset($home) ? '/' . $home : "/"; ?>"><?php echo isset($logo) ? $logo : ' '; ?></a></li>
                </div>
                 <div class="nav-link-wrapper flex-center">
                <li><a href=""><?php echo isset($userName) ? $userName : ''; ?></a></li>
                <li><a href=""><?php echo isset($logoutUrl) ? $logoutUrl : ''; ?></a></li>
                <li> <button id="toggleSidebar"><?php echo isset($user) ? $user  : '';?> </button></li>
                <li ><a class="btn" href="/<?php echo isset($page) ? $page : ' '?>"><?php echo isset($btn) ? $btn : ' '; ?></a></li>
                </div>
            </ul>
        </nav>
    </header>
    <main>
        <?= $content; ?>
    </main>
 <?php include "footer.view.php";?>
<script src="./app/Scripts/toggleComment.js"></script>
<script src="./app/Scripts/toggleNav.js"></script>
<script src="./app/Scripts/dashboard.js"></script>
<script src="./app/Scripts/filter.js"></script>

</body>
</html>
