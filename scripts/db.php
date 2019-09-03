<?php

$driver = 'mysql';
$host = 'localhost';
$db_name = 'renby';
$db_user = 'root';
$db__pass = '';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO("$driver:host=$host;dbname=$db_name;charset=$charset", $db_user, $db__pass, $options);
} catch(PDOExeption $e) {
    die("Ошибка подключения к базе данных");
}