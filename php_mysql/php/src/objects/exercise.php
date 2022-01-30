<?php
class Exercise{
 
    // database connection and table name
    private $conn;
    private $table_name = "exercise";

	// object properties
    public $id;
    public $name;
    public $description;
    public $image_base64;
    public $profile_id;//transient

    public function __construct($db){
        $this->conn = $db;
    }

    public function readAll(){
        //select all data
        $query = "SELECT
                    id, name, description, image_base64
                FROM
                    " . $this->table_name . " ORDER BY name ASC";
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }

    // read products with pagination
    public function readPaging($from_record_num, $records_per_page){

        // select query
        $query = "SELECT
                      id, name, description, image_base64
                  FROM
                      " . $this->table_name . " ORDER BY name ASC
                  LIMIT ?, ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        // return values from database
        return $stmt;
    }

    // used for paging products
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }
    // used for paging products
    public function countByProfile(){
    $query = "SELECT COUNT(*) as total_rows FROM "
        . $this->table_name . " e "
        . "JOIN profile_exercise pe ON e.id=pe.exercise_id "
        . "WHERE pe.profile_id = ?"
        ;

        $stmt = $this->conn->prepare( $query );
        $this->profile_id=htmlspecialchars(strip_tags($this->profile_id));
        $stmt->bindParam(1, $this->profile_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

	function readOne(){	 
		// query to read single record
		$query = "SELECT
					p.id, p.name, p.description, p.image_base64
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
		$this->description = $row['description'];
		$this->image_base64 = $row['image_base64'];
	}

	// create product
	function create(){
	 
		// query to insert record
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
                name=:name, description=:description, image_base64=:image_base64";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->description=htmlspecialchars(strip_tags($this->description));
		$this->image_base64=htmlspecialchars(strip_tags($this->image_base64));
	 
		// bind values
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":description", $this->description);
		$stmt->bindParam(":image_base64", $this->image_base64);
	 
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
					name = :name,
					description = :description,
                    image_base64 = :image_base64
				WHERE
					id = :id";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->description=htmlspecialchars(strip_tags($this->description));
		$this->image_base64=htmlspecialchars(strip_tags($this->image_base64));
		$this->id=htmlspecialchars(strip_tags($this->id));
	 
		// bind new values
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':image_base64', $this->image_base64);
		$stmt->bindParam(':id', $this->id);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function findAllByProfile(){
        $query = "SELECT pe.id as id, e.name as name, e.description as description, e.image_base64 as image_base64, pe.is_done as is_done FROM "
				. $this->table_name . " e "
				. "JOIN profile_exercise pe ON e.id=pe.exercise_id "
				. "WHERE pe.profile_id = ?"
				. "ORDER BY is_done ASC, id ASC"
				;
        $stmt = $this->conn->prepare( $query );
		$this->profile_id=htmlspecialchars(strip_tags($this->profile_id));
		$stmt->bindParam(1, $this->profile_id);
        $stmt->execute();
 
        return $stmt;
	}

	function readPagingByProfile($from_record_num, $records_per_page){
        $query = "SELECT pe.id as id, e.name as name, e.description as description, e.image_base64 as image_base64, pe.is_done as is_done FROM "
                . $this->table_name . " e "
                . "JOIN profile_exercise pe ON e.id=pe.exercise_id "
                . "WHERE pe.profile_id = ? "
                . "ORDER BY is_done ASC, id ASC "
                . "LIMIT ?, ? "
                ;
        $stmt = $this->conn->prepare( $query );
        $this->profile_id=htmlspecialchars(strip_tags($this->profile_id));

        $stmt->bindParam(1, $this->profile_id);
        $stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    	// read products with pagination
//             public function readPaging($from_record_num, $records_per_page){
//
//                 // select query
//                 $query = "SELECT
//                               id, name, description, image_base64
//                           FROM
//                               " . $this->table_name . " ORDER BY name ASC
//                           LIMIT ?, ?";
//
//                 // prepare query statement
//                 $stmt = $this->conn->prepare( $query );
//
//                 // bind variable values
//                 $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
//                 $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
//
//                 // execute query
//                 $stmt->execute();
//
//                 // return values from database
//                 return $stmt;
//             }

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