<?php
class Students{
 
    // database connection and table name
    private $conn;
    private $table_name = "studentdetails";
 
    // object properties
    public $id;
    public $name;
    public $course;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    
    // read products
    function read(){
 
        // select all query
        $query = "SELECT * FROM " . $this->table_name ;
 
        // prepare query statement
        $stmt = $this->conn->prepare($query);
 
        // execute query
        $stmt->execute();
 
        return $stmt;
    }
    
    
    // create product
    function create(){
 
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, course=:course";
 
    // prepare query
        $stmt = $this->conn->prepare($query);
 
    // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->courses=htmlspecialchars(strip_tags($this->course));
    // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":course", $this->course);
 
    // execute query
        if($stmt->execute()){
            return true;
        }
 
        return false;
     
    }

    function update(){
        // query to insert record
        $query = "UPDATE " . $this->table_name . " SET name=:name, course=:course WHERE id = :id";
 
    // prepare query
        $stmt = $this->conn->prepare($query);
 
    // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->course=htmlspecialchars(strip_tags($this->course));
    // bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":course", $this->course);
 
    // execute query
        if($stmt->execute()){
            return true;
        }
 
        return false;      
    }
    
    
    

    function delete(){
        // query to delete record
        
       // $sql = "delete from from course_master"; 
       // $result = mysqli_query($db, $sql);
            $query  = "Delete from ".$this->table_name." WHERE id=:id";

        //prepare query 
            $stmt = $this->conn->prepare($query);

        //sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));

        //bind values
            $stmt->bindParam(":id", $this->id);

        // execute query
            if($stmt->execute())
            {
                return true;
            }

            return false;
    }    
    
    // used when filling up the update product form
    function readOne(){
 
        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
 
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
 
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
 
        // execute query
        $stmt->execute();
 
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // set values to object properties
        $this->name = $row['name'];
        $this ->id =  $row['id'];
        $this->course = $row['course'];
        
    }
        
}