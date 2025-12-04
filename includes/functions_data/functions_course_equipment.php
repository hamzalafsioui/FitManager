<?php

require_once __DIR__ . "/../../db.php";

function getAllCourseEquipment() {
    global $pdo;

    $sql = " SELECT ce.course_id,ce.equipment_id,c.name AS course_name,cat.name AS category_name,
            e.name AS equipment_name,
            et.type_name
        FROM course_equipment ce
        JOIN courses c ON ce.course_id = c.id
        JOIN categories cat ON c.category_id = cat.id
        JOIN equipments e ON ce.equipment_id = e.id
        JOIN equipment_types et ON e.type_id = et.id
        ORDER BY c.name ASC, e.name ASC
    ";

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function addCourseEquipment($data) {
    global $pdo;
    $stmt = $pdo->prepare(" INSERT INTO course_equipment (course_id, equipment_id) 
    VALUES (?, ?)
    ");
    return $stmt->execute([$data["course_id"], $data["equipment_id"]]);
}

