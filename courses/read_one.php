<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/courses.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$course = new Courses($db);
 
// set ID property of product to be edited
$course->cid = isset($_GET['cid']) ? $_GET['cid'] : die();
 
// read the details of product to be edited
$course->readOne();
 
// create array
$courses = array(
    "cid" =>  $course->cid,
    "cname" => $course->cname,
    "cduration" => $course -> cduration
 
);
 
// make it json format
print_r(json_encode($courses));
?>