<?php
namespace App\Views;
// Simulate fetching content (e.g., dashboard content)
$home = "home";
$content = include 'homePage.php';
$user = $user['username'];
$page = "logout";
$btn = "Logout";
$logo = "Meetand";
$pageTitle = $user . " - home";
include 'template.php';
