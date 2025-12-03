<?php
require_once __DIR__ . "/functions_courses.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = [
        "name" => $_POST["name"],
        "category_id" => $_POST["category_id"],
        "course_date" => $_POST["course_date"],
        "course_time" => $_POST["course_time"],
        "duration" => $_POST["duration"],
        "max_participants" => $_POST["max_participants"],
    ];

    // Insert and get inserted ID
    $newId = addCourse($data);

    if ($newId) {
        $course = getCourseById($newId);

        echo json_encode([
            "status" => "success",
            "course" => $course
        ]);
        exit;
    }

    echo json_encode(["status" => "error"]);
}
