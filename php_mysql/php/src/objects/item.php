<?php
class Item{
 
    // database connection and table name
    private $conn;
    private $table_name = "item";
	
	// object properties
    public $id;
    public $category_id;
    public $name;
    public $price;
    public $checked;
	
	public function __construct($db){
        $this->conn = $db;
    }
 	
	function readOne(){	 
		// query to read single record
		$query = "SELECT
					p.id, p.category_id, p.name, p.price, p.checked
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
		$this->category_id = $row['category_id'];
		$this->name = $row['name'];
		$this->price = $row['price'];
		$this->checked = $row['checked'];
	}
	
	public function readAllByCategoryId($category_id = 1){
        //select all data
        $query = "SELECT
                    id, category_id, name, price, checked
                FROM
                    " . $this->table_name . "
				WHERE 
					category_id = " . $category_id . "
				ORDER BY name ASC 					";
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
	
	// used for paging products
	public function getLastId(){
		$query = "SELECT 
					id as last_id 
				FROM 
					" . $this->table_name . "
				ORDER BY 1 DESC 
				LIMIT 1";
	 
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		return $row['last_id'];
	}
	
	// create product
	function create(){
	 
		// query to insert record
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					category_id=:category_id, name=:name, price=:price, checked=0";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->category_id=htmlspecialchars(strip_tags($this->category_id));
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->price=htmlspecialchars(strip_tags($this->price));
	 
		// bind values
		$stmt->bindParam(":category_id", $this->category_id);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":price", $this->price);
	 
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
					price = :price,
                    checked = :checked
				WHERE
					id = :id";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->price=htmlspecialchars(strip_tags($this->price));
		$this->checked=htmlspecialchars(strip_tags($this->checked));
		$this->id=htmlspecialchars(strip_tags($this->id));
	 
		// bind new values
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':price', $this->price);
		$stmt->bindParam(':checked', $this->checked);
		$stmt->bindParam(':id', $this->id);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	
	// delete the product
	function check(){
	    // delete query
	    $query = "UPDATE
					" . $this->table_name . "
				SET
					checked = :checked
				WHERE
					id = :id";
	    // prepare query statement
	    $stmt = $this->conn->prepare($query);
	    
	    // sanitize
	    $this->checked=htmlspecialchars(strip_tags($this->checked));
	    $this->id=htmlspecialchars(strip_tags($this->id));
	    
	    // bind new values
	    $stmt->bindParam(':checked', $this->checked);
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
	// delete the product
	function deleteByCategory(){	 
		$query = "DELETE FROM " . $this->table_name . " WHERE category_id = ?";
		$stmt = $this->conn->prepare($query);
		$this->category_id=htmlspecialchars(strip_tags($this->category_id));
		$stmt->bindParam(1, $this->category_id);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
}