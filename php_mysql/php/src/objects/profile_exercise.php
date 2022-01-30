<?php
class ExerciseProfile{
 
    // database connection and table name
    private $conn;
    private $table_name = "profile_exercise";

	// object properties
    public $id;
    public $profile_id;
    public $exercise_id;
    public $is_done;

    public function __construct($db){
        $this->conn = $db;
    }


	// create product
	function create(){
	 
		// query to insert record
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
                profile_id=:profile_id, exercise_id=:exercise_id, is_done=0";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->profile_id=htmlspecialchars(strip_tags($this->profile_id));
		$this->exercise_id=htmlspecialchars(strip_tags($this->exercise_id));
	 
		// bind values
		$stmt->bindParam(":profile_id", $this->profile_id);
		$stmt->bindParam(":exercise_id", $this->exercise_id);
	 
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
					is_done = :is_done
				WHERE
					id = :id";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->is_done=htmlspecialchars(strip_tags($this->is_done));
		$this->id=htmlspecialchars(strip_tags($this->id));
	 
		// bind new values
		$stmt->bindParam(':is_done', $this->is_done);
		$stmt->bindParam(':id', $this->id);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function reset(){	 
		// update query
		$query = "UPDATE
					" . $this->table_name . "
				SET
					is_done = :is_done
				WHERE
					profile_id = :profile_id";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->is_done=htmlspecialchars(strip_tags($this->is_done));
		$this->profile_id=htmlspecialchars(strip_tags($this->profile_id));
	 
		// bind new values
		$stmt->bindParam(':is_done', $this->is_done);
		$stmt->bindParam(':profile_id', $this->profile_id);
	 
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

	// delete the product
	function deleteByProfile(){	 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE profile_id = ?";
		// prepare query
		$stmt = $this->conn->prepare($query);
		// sanitize
		$this->profile_id=htmlspecialchars(strip_tags($this->profile_id));
		// bind id of record to delete
		$stmt->bindParam(1, $this->profile_id);
		// execute query
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
}