<?php

namespace App\View;

// Simulate fetching content (e.g., dashboard content)

$content = include 'signupForm.php';
$currentPageHome = 'signup';
$page = 'login';
$btn = 'Login';
$logo = 'Meetand';
$pageTitle = 'Sign up';
// Include the template and pass the content to be injected
include 'template.php';
