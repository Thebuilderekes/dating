<?php
Namespace App\Views;
// Simulate fetching content (e.g., dashboard content)

$content = include 'signUpForm.view.php';
$page = "login";
$btn = "Login";
$logo = "Meetand";
$pageTitle = "Sign up";
// Include the template and pass the content to be injected
include 'template.view.php';
