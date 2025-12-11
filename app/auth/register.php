<?php
// ================ Display Errors =================
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// =================================================

session_start();
require_once __DIR__ . "/../../includes/functions_data/functions_auth.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $gender = $_POST["gender"] ?? null;
    $age = !empty($_POST["age"]) ? (int)$_POST["age"] : null;

    // check is Password match 
    if ($password !== $confirm_password) {
        $_SESSION["error"] = "Passwords do not match.";
        header("Location: ../../public/register.php");
        exit;
    }

    // Is email already exist
    if (getUserByEmail($email)) {
        $_SESSION["error"] = "This email is already registered.";
        header("Location: ../../public/register.php");
        exit;
    }

    // Create new user
    if (createUser($email, $password, $first_name, $last_name, $gender, $age)) {
        $_SESSION["success"] = "Account created successfully!";
        header("Location: ../../public/login.php");
        exit;
    } else {
        $_SESSION["error"] = "Failed to create account. Please try again.";
        header("Location: ../../public/register.php");
        exit;
    }
}
