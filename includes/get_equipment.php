<?php
require_once __DIR__ . "/functions_data/functions_equip.php";

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $equip = getEquipmentById($id); 

    if ($equip) {
        echo json_encode([
            "status" => "success",
            "data" => $equip
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Equipment not found."
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "ID not provided."
    ]);
}
