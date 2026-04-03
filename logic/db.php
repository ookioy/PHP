<?php
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