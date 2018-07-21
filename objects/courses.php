<?php
class Courses{
 
    // database connection and table name
    private $conn;
    private $table_name = "course_master";
 
    // object properties
    public $cid;
    public $cname;
    public $cduration;
 
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
        $query = "INSERT INTO " . $this->table_name . " SET cname=:cname, cduration=:cduration";
 
    // prepare query
        $stmt = $this->conn->prepare($query);
 
    // sanitize
        $this->cname=htmlspecialchars(strip_tags($this->cname));
        $this->cduration=htmlspecialchars(strip_tags($this->cduration));
    // bind values
        $stmt->bindParam(":cname", $this->cname);
        $stmt->bindParam(":cduration", $this->cduration);
 
    // execute query
        if($stmt->execute()){
            return true;
        }
 
        return false;
     
    }
    
    function update(){
        // query to insert record
        $query = "UPDATE " . $this->table_name . " SET cname=:cname, cduration=:cduration WHERE cid = :cid";
 
    // prepare query
        $stmt = $this->conn->prepare($query);
 
    // sanitize
        $this->cid=htmlspecialchars(strip_tags($this->cid));
        $this->cname=htmlspecialchars(strip_tags($this->cname));
        $this->cduration=htmlspecialchars(strip_tags($this->cduration));
    // bind values
        $stmt->bindParam(":cid", $this->cid);
        $stmt->bindParam(":cname", $this->cname);
        $stmt->bindParam(":cduration", $this->cduration);
 
    // execute query
        if($stmt->execute()){
            return true;
        }
 
        return false;      
    }
    
    
    

    function delete(){
        // query to delete record
            $query  = "Delete from ".$this->table_name." WHERE cid=:cid";

        //prepare query 
            $stmt = $this->conn->prepare($query);

        //sanitize
            $this->cid=htmlspecialchars(strip_tags($this->cid));

        //bind values
            $stmt->bindParam(":cid", $this->cid);

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
        $query = "SELECT * FROM " . $this->table_name . " WHERE cid = ?";
 
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
 
        // bind id of product to be updated
        $stmt->bindParam(1, $this->cid);
 
        // execute query
        $stmt->execute();
 
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // set values to object properties
        $this->cname = $row['cname'];
        $this ->cid =  $row['cid'];
        $this->cduration = $row['cduration'];
        
    }
        
}