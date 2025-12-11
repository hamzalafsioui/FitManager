<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION["user_id"]);
}

function role() {
    return $_SESSION["role_id"] ?? null;
}

function isAdmin() {
    return role() === 1; // admin = role_id = 1
}

function isTrainer() {
    return role() === 2;
}

function isMember() {
    return role() === 3;
}

// no logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: ../public/login.php");
        exit;
    }
}

// allow only certain roles
function requireRole(array $roles) {
    if (!in_array(role(), $roles)) {
        header("Location: ../public/unauthorized.php");
        exit;
    }
}
