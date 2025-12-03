<?php

require_once __DIR__ . "/../../db.php";


function getAllCourses(){
    global $pdo;
   $sql = "SELECT c.id,c.name,c.category_id,c.course_date,c.course_time,c.duration,c.max_participants,
            cat.name AS category_name
        FROM courses c
        JOIN categories cat ON c.category_id = cat.id
        ORDER BY c.course_date ASC
    ";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function getCourseById($id){
    global $pdo;
     $stmt = $pdo->prepare("SELECT c.id,c.name,c.category_id,c.course_date,c.course_time,c.duration,
            c.max_participants,
            cat.name AS category_name
        FROM courses c
        JOIN categories cat ON c.category_id = cat.id
        WHERE c.id = ?
    ");
    $stmt->execute(["$id"]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function addCourse($data){
    global $pdo;
    $stmt = $pdo->prepare(
        "INSERT INTO courses (name,category_id,course_date,course_time,duration,max_participants) 
        VALUES (?,?,?,?,?,?)"
    );

    $result = $stmt->execute([
        $data["name"],
        $data["category_id"],
        $data["course_date"],
        $data["course_time"],
        $data["duration"],
        $data["max_participants"],
    ]);
    return $pdo->lastInsertId(); // return last id
}

function deleteCourseById($id){
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");

    return $stmt->execute(["$id"]);
}

function updateCourseById($id, $data) {
    global $pdo;
    $stmt = $pdo->prepare("
        UPDATE courses SET
        name=?, category_id=?, course_date=?, course_time=?, duration=?, max_participants=?
        WHERE id=?
    ");
    return $stmt->execute([
        $data["name"],
        $data["category_id"],
        $data["course_date"],
        $data["course_time"],
        $data["duration"],
        $data["max_participants"],
        $id
    ]);
}

function getAllCategories(){
    global $pdo;
    return  $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
}

function getTotalCourses(){
    global $pdo;
    $stmt =  $pdo->query("SELECT count(*) AS total_courses FROM courses");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result["total_courses"];

}



$count = getTotalCourses();
// echo $count;


$customVariable = getAllCourses();
// print_r($customVariable);

$newVar = getCourseById(1);
// print_r($customVariable);

$insertedData = [
    "name"=> "Yoga x",
    "category_id"=>1,
    "course_date"=> date("Y-m-d"),
    "course_time"=>"08:00:00",
    "duration"=>40,
    "max_participants"=>10,
];


// $eqs = addCourse($insertedData);
// echo $eqs;

// $insertDataReturn = addCourse($insertedData);

// $deleteCourse = deleteCourse(4);
// echo $deleteCourse;

// $updatedData = updateCourseById(3,$insertedData);
// echo $updatedData;

// $categories = getAllCategories();
// print_r($categories);
?>