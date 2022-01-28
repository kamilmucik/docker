<?php
class Profile{
 
    // database connection and table name
    private $conn;
    private $table_name = "profile";

	// object properties
    public $id;
    public $name;

    public function __construct($db){
        $this->conn = $db;
    }

    public function readAll(){
        //select all data
        $query = "SELECT
                    id, name
                FROM
                    " . $this->table_name . " ORDER BY name ASC";
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }


}