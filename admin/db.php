<?php
header("Content-Type: text/html; charset=utf-8;");
session_start();
$host = 'localhost';
$db = 'fence';
$user = 'kezo';
$pass = 'faulHEIT_1988';
// Подключение к базе данных
$connection = new PDO("mysql:host=" . $host . ";dbname=" . $db . ";charset=utf8", $user, $pass);
?>