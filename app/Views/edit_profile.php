<?php
Namespace App\Views;
// Simulate fetching content (e.g., dashboard content)
$user = $user['username'];
$content = include 'edit_profileform.php';
$btn = "Logout";
$logo = "Meetand";
$pageTitle = $user . " - edit profile";
// Include the template and pass the content to be injected
include 'template.php';



