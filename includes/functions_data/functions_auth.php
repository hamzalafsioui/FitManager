<?php
require_once __DIR__ . "/../../db.php";


function getUserByEmail(string $email) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// ?int $age => ? can contains value or null

function createUser(string $email, string $password, string $first_name, string $last_name, string $gender, int $age, int $role_id = 2) {
    global $pdo;
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO users (email, password_hash, role_id, first_name, last_name, gender, age)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    return $stmt->execute([
        $email,
        $hash,
        $role_id,
        $first_name,
        $last_name,
        $gender,
        $age
    ]);
}


function loginUser(string $email, string $password) {
    $user = getUserByEmail($email);

    if ($user && password_verify($password, $user['password_hash'])) {
        return $user;
    }

    return false;
}

