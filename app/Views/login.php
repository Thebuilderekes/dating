<?php
Namespace App\Views;
// Simulate fetching content (e.g., dashboard content)
$content = include 'loginForm.php';
$btn = "Sign Up";
$logo = "Meetand";
$pageTitle = "log in - Meetand";
// Include the template and pass the content to be injected
include 'template.php';
