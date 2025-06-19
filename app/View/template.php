<?php

namespace App\View;

$content = $content ?? '';
$logoutUrl = $logoutUrl ?? '';
$home = $home ?? '';
$currentPageHome = $currentPageHome ?? '';
$userName = $userName ?? '';
$user = $user ?? '';
$page = $page ?? '';
$btn = $btn ?? '';
$logo = $logo ?? '';
$pageTitle = $pageTitle ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $pageTitle ? $pageTitle : 'Default Title'; ?>
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
                     <li><a href="<?php echo $home ? '/'.$home : '/'.$currentPageHome; ?>"><?php echo $logo ? $logo : ' '; ?></a></li>
                </div>
                 <div class="nav-link-wrapper flex-center">
                <li><a href=""><?php echo $userName; ?></a></li>
                <li><a href=""><?php echo $logoutUrl; ?></a></li>
                <li> <button id="toggleside-nav"><?php echo $user; ?> </button></li>
                <li ><a class="btn" href="/<?php echo $page; ?>"><?php echo $btn; ?></a></li>
                </div>
            </ul>
        </nav>
    </header>
    <main>
        <?= $content; ?>
    </main>
 <?php include 'footer.view.php'; ?>
<script src="./app/Scripts/toggleComment.js"></script>
<script src="./app/Scripts/toggleNav.js"></script>
<script src="./app/Scripts/dashboard.js"></script>
<script src="./app/Scripts/filter.js"></script>

</body>
</html>
