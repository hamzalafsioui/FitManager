<?php

require_once __DIR__ . "/functions_data/functions_equip.php";

header("Content-Type: application/json");

// Check if ID is provided
if (!isset($_GET["id"])) {
    echo json_encode(["status" => "error", "message" => "No ID provided"]);
    exit;
}

$id = $_GET["id"];

$result = deleteEquipmentById($id);

if ($result["status"] === "success") {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Equipment is linked to a course"]);
}
exit;
