<?php

require_once __DIR__ . "/functions_data/functions_courses.php";

header("Content-Type: application/json");

if (!isset($_GET["id"])) {
    echo json_encode(["status" => "error", "message" => "No ID"]);
    exit;
}

$id = $_GET["id"];

if (deleteCourseById($id)) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}
exit;
