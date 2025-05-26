<?php
namespace App\Views;
// Simulate fetching content (e.g., dashboard content)
$home = "home";
$content = include 'homePage.view.php';
$user = $user['username'];
$page = "logout";
$btn = "Logout";
$logo = "Meetand";
$pageTitle = $user . "-home page";
include 'template.view.php';
