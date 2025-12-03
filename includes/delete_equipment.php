<?php

require_once __DIR__ . "/functions_data/functions_equip.php";

header("Content-Type: application/json");

// Check if ID is provided
if (!isset($_GET["id"])) {
    echo json_encode(["status" => "error", "message" => "No ID provided"]);
    exit;
}

$id = $_GET["id"];

if (deleteEquipmentById($id)) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}
exit;
