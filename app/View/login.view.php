<?php

namespace App\View;

// Simulate fetching content (e.g., dashboard content)
$content = include 'loginForm.php';
$currentPageHome = 'signup';
$btn = 'Sign Up';
$page = 'signup';
$logo = 'Meetand';
$pageTitle = 'log in - Meetand';
// Include the template and pass the content to be injected
include 'template.php';
