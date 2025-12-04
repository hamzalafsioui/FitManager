<?php
$isDocker = getenv('DOCKER_ENV');

$host = $isDocker ? 'mysql' : '127.0.0.1';
$user = $isDocker ? 'fituser' : 'root';
$pass = $isDocker ? 'password' : 'Sa@123456';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=fit_manager;charset=utf8",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
