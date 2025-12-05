<?php

require_once __DIR__ . "/../../db.php";

function getAllEquipments()
{
    global $pdo;
    $sql = "SELECT e.*, t.type_name, s.state_name
            FROM equipments e
            JOIN equipment_types t ON e.type_id = t.id
            JOIN equipment_states s ON e.state_id = s.id";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function getEquipmentById($id)
{
    global $pdo;
    $stmt = $pdo->prepare(" SELECT e.*, t.type_name, s.state_name, t.id AS type_id, s.id AS state_id
        FROM equipments e
        JOIN equipment_types t ON e.type_id = t.id
        JOIN equipment_states s ON e.state_id = s.id
        WHERE e.id = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addEquipment($data)
{
    global $pdo;
    $stmt = $pdo->prepare("
        INSERT INTO equipments (name, type_id, quantity, state_id)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([
        $data["name"],
        $data["type_id"],
        $data["quantity"],
        $data["state_id"]
    ]);

    return $pdo->lastInsertId();
}

function updateEquipmentById($id, $data)
{
    global $pdo;
    $stmt = $pdo->prepare("
        UPDATE equipments
        SET name=?, type_id=?, quantity=?, state_id=?
        WHERE id=?
    ");
    return $stmt->execute([
        $data["name"],
        $data["type_id"],
        $data["quantity"],
        $data["state_id"],
        $id
    ]);
}

function deleteEquipmentById($id)
{
    global $pdo;

    // Check if equipment is linked
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM course_equipment WHERE equipment_id = ?");
    $stmt->execute([$id]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        return ["status" => "linked"];
    }

    // If not linked, delete
    $stmt = $pdo->prepare("DELETE FROM equipments WHERE id = ?");
    $stmt->execute([$id]);

    return ["status" => "success"];
}


function getAllTypes()
{
    global $pdo;
    return $pdo->query("SELECT * FROM equipment_types")->fetchAll(PDO::FETCH_ASSOC);
}

function getAllStates()
{
    global $pdo;
    return $pdo->query("SELECT * FROM equipment_states")->fetchAll(PDO::FETCH_ASSOC);
}

function getTotalEquipments()
{
    global $pdo;
    $stmt =  $pdo->query("SELECT count(*) AS total_equipments FROM equipments");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result["total_equipments"];
}


$insertedData = [
    "name" => "Gym Ball_",
    "type_id" => 2,
    "quantity" => 8,
    "state_id" => 2

];
// $eqs = getAllEquipments();
// $eqs = deleteEquipmentById(4);
// echo print_r($eqs);

// $tota_eq = getTotalEquipments();
// echo $tota_eq;

// print_r(deleteEquipmentById(1));
// echo deleteEquipmentById(1)["status"];
// if(deleteEquipmentById(1)["status"] === "linked"){
//     echo " linked";
// }
