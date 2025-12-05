<?php
require_once __DIR__ . "/functions_data/functions_courses.php";

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(["status" => "error", "message" => "No ID provided"]);
    exit;
}

$id = intval($_GET['id']);
$course = getCourseById($id);

if ($course) {
    echo json_encode(["status" => "success", "data" => $course]);
} else {
    echo json_encode(["status" => "error", "message" => "Course not found"]);
}
