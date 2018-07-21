<?php
class Database{
    
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "demousers";
    private $db_username = "root";
    private $db_password = "";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->db_username, $this->db_password);
            $this->conn->exec("set names utf8");
            //echo 'success';
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>