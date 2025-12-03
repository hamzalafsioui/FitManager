<?php
require_once __DIR__ . "/functions_data/functions_equip.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $data = [
        "name" => $_POST['name'],
        "type_id" => $_POST['type_id'],
        "quantity" => $_POST['quantity'],
        "state_id" => $_POST['state_id']
    ];

    $updated = updateEquipmentById($id, $data);

    if ($updated) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to update equipment."
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request."
    ]);
}
