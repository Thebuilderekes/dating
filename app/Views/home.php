<?php
namespace App\Views;
// Simulate fetching content (e.g., dashboard content)
$content = include 'homePage.php';
$toggleComment = include './app/scripts/toggleComment.php';
$user = $user['username'];
$page = "logout";
$btn = "Logout";
$logo = "Meetand";
$pageTitle = $user . "-home page";
include 'template.php';
