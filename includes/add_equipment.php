<?php

require_once __DIR__ . "/functions_data/functions_equip.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = [
        "name" => $_POST["name"],
        "quantity" => $_POST["quantity"],
        "type_id" => $_POST["type_id"],
        "state_id" => $_POST["state_id"],
    ];

    // Insert and get inserted ID
    $newId = addEquipment($data);

    if ($newId) {
        $equipment = getEquipmentById($newId);

        echo json_encode([
            "status" => "success",
            "data" => $equipment
        ]);
        exit;
    }

    echo json_encode(["status" => "error"]);
}
