<?php
namespace App\Views\admin;
// Simulate fetching content (e.g., dashboard content)
$content = include __DIR__ . ('/dashboard.php');
$page = "admin_logout";
$btn = "Logout";
$logo = "Meetand";
$pageTitle = "Meetand - admin dashboard";
include __DIR__ . ('/../template.php');

