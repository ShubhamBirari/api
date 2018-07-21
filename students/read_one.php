<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/students.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$student = new Students($db);
 
// set ID property of product to be edited
$student->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$student->readOne();
 
// create array
$courses = array(
    "id" =>  $student->id,
    "name" => $student->name,
    "courses" => $student->course
 
);
 
// make it json format
print_r(json_encode($courses));
?>