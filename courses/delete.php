<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/courses.php';
 
$database = new Database();
$db = $database->getConnection();
 
$course = new Courses($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set course property values
$course->cid = $data->cid;
 
//Add new course details
if($course->delete()){
    echo '{';
        echo '"message": "Data deleted."';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to delete data."';
    echo '}';
}
?>