<?php
require_once('./vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


define('DB_HOST', $_ENV['DB_HOST']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_PASS', $_ENV['DB_PASS']);
define('DB_USER', $_ENV['DB_USER']);
//define('DB_ADMIN_USER', $_ENV['ADMIN_USERNAME']);
//define('DB_ADMIN_PASS', $_ENV['ADMIN_PASSWORD']);


