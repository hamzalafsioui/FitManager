<?php
require_once __DIR__ . "/functions_data/functions_course_equipment.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = [
        "course_id" => $_POST["course_id"],
        "equipment_id" => $_POST["equipment_id"]
    ];

    if (addCourseEquipment($data)) {
        header("Location: ../public/index.php?success=1");
        exit;
    }

    header("Location: ../public/index.php?error=1");
    exit;
}
?>
