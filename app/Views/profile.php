<?php
namespace App\Views;
// Simulate fetching content (e.g., dashboard content)
$content = include 'profilePage.php';
$user = $user['username'];
$page = "logout";
$btn = "Logout";
$logo = "Meetand";
$pageTitle = $user . "-profile page";
include 'template.php';
