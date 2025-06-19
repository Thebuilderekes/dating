<?php

namespace App\View\admin;

// Simulate fetching content (e.g., dashboard content)
$content = include __DIR__.('/login.php');
$page = 'admin_login';
$btn = 'login';
$logo = 'Meetand';
$pageTitle = 'Meetand - Admin Login';
include __DIR__.('/../template.php');
