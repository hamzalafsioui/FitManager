<?php
require_once __DIR__ . "/../db.php";

function getAllEquipments() {
    global $pdo;
    $sql = "SELECT e.*, t.type_name, s.state_name
            FROM equipments e
            JOIN equipment_types t ON e.type_id = t.id
            JOIN equipment_states s ON e.state_id = s.id";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function getEquipmentById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM equipments WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addEquipment($data) {
    global $pdo;
    $stmt = $pdo->prepare("
        INSERT INTO equipments (name, type_id, quantity, state_id)
        VALUES (?, ?, ?, ?)
    ");
    return $stmt->execute([
        $data["name"],
        $data["type_id"],
        $data["quantity"],
        $data["state_id"]
    ]);
}

function updateEquipmentById($id, $data) {
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

function deleteEquipmentById($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM equipments WHERE id=?");
    return $stmt->execute([$id]);
}

function getAllTypes() {
    global $pdo;
    return $pdo->query("SELECT * FROM equipment_types")->fetchAll(PDO::FETCH_ASSOC);
}

function getAllStates() {
    global $pdo;
    return $pdo->query("SELECT * FROM equipment_states")->fetchAll(PDO::FETCH_ASSOC);
}


$insertedData = [
    "name"=> "Gym Ball_",
    "type_id"=>2,
    "quantity"=> 8,
    "state_id"=>2
    
];
// $eqs = addEquipment($insertedData);
// $eqs = deleteEquipmentById(4);
echo print_r($eqs);

?>



