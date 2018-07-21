<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
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
 
// set product property values
$course->cid = $data->cid;
$course->cname = $data->cname;
$course->cduration = $data->cduration;
 
// create the product
if($course->update()){
    echo '{';
        echo '"message": "Data updated."';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update data."';
    echo '}';
}
?>