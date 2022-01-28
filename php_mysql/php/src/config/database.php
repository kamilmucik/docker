<?php
class Database{
 
    // specify your own database credentials
    private $host = "db";
    private $db_name = "MYSQL_DATABASE";
    private $username = "MYSQL_USER";
    private $password = "MYSQL_PASSWORD";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            // $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>
