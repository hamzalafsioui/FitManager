<?php
session_start();
require_once __DIR__ . "/../../includes/functions_data/functions_auth.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // login
    $user = loginUser($email, $password);

    if ($user) {
        // store session
        $_SESSION["user_id"]  = $user["id"];
        $_SESSION["role_id"]  = $user["role_id"];
        $_SESSION["fullname"] = $user["first_name"] . " " . $user["last_name"];

        // redirect to dashboard
        header("Location: ../../public/index.php");
        exit;
    }

    // Incorrect login
    $_SESSION["error"] = "Invalid email or password.";
    header("Location: ../../public/login.php");
    exit;
}
