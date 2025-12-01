<?php
$pdo = new PDO(
    "mysql:host=localhost;dbname=fit_manager;charset=utf8",
    "root",
    "Sa@123456",
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
