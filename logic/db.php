<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$db   = 'PHP';
$user = 'products_admin';
$pass = 'admin123';
$charset = 'utf8mb4';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Помилка підключення: " . $mysqli->connect_error);
}

$mysqli->set_charset($charset);