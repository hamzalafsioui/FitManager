<?php
require_once __DIR__ . "/functions_data/functions_courses.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $data = [
        "name" => $_POST['name'],
        "category_id" => $_POST['category_id'],
        "course_date" => $_POST['course_date'],
        "course_time" => $_POST['course_time'],
        "duration" => $_POST['duration'],
        "max_participants" => $_POST['max_participants']
    ];

    $updated = updateCourseById($id, $data);

    if ($updated) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update course."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
