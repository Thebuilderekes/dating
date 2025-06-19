<?php

namespace App\View;

// Simulate fetching content (e.g., dashboard content)
$home = 'home';
$content = include 'homePage.php';
$user = $user['username'];
$currentPageHome = 'home';
$page = 'logout';
$btn = 'Logout';
$logo = 'Meetand';
$pageTitle = $user.' - home';
include 'template.php';
