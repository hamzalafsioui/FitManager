<?php

require_once __DIR__ . "/../db.php";

function getAllCourses(){
    global $pdo;
    $sql = "SELECT c.*,cat.name As category_name FROM courses c JOIN categories cat ON c.category_id = cat.id ORDER BY c.course_date ASC";

    RETURN $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}


?>