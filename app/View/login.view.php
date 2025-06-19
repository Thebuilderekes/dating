<?php

namespace App\View;

// Simulate fetching content (e.g., dashboard content)
$content = include 'loginForm.php';
$currentPageHome = 'signUp';
$btn = 'Sign Up';
$page = 'signUp';
$logo = 'Meetand';
$pageTitle = 'log in - Meetand';
// Include the template and pass the content to be injected
include 'template.php';
