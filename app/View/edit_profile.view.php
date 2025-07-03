<?php

namespace App\View;

// Simulate fetching content (e.g., dashboard content)
$user = $user['username'];
$content = include 'edit_profileForm.php';
$btn = 'Logout';
$home = "home";
$logo = 'Meetand';
$pageTitle = $user.' - edit profile';
// Include the template and pass the content to be injected
include 'template.php';
