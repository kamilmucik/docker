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

	function readOne(){	 
		// query to read single record
		$query = "SELECT
					p.id, p.name
				FROM
					" . $this->table_name . " p
				WHERE
					p.id = ?
				LIMIT
					0,1";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->id);
	 
		// execute query
		$stmt->execute();
	 
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		// set values to object properties
		$this->id = $row['id'];
		$this->name = $row['name'];
	}


	// create product
	function create(){
	 
		// query to insert record
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
                name=:name";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->name=htmlspecialchars(strip_tags($this->name));
	 
		// bind values
		$stmt->bindParam(":name", $this->name);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function update(){	 
		// update query
		$query = "UPDATE
					" . $this->table_name . "
				SET
					name = :name
				WHERE
					id = :id";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->id=htmlspecialchars(strip_tags($this->id));
	 
		// bind new values
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':id', $this->id);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	// delete the product
	function delete(){	 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
		// prepare query
		$stmt = $this->conn->prepare($query);
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));
		// bind id of record to delete
		$stmt->bindParam(1, $this->id);
		// execute query
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}

}