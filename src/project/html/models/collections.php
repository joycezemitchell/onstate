<?php 
require_once "utils.php";
require_once "dbconnection.php";

class Collections {
	
	public $Id; 
	public $Handle;
	public $Title;
	public $Updated_at;
	public $Published_at;
	public $Body_html;
	public $Sort_order;
	public $Template_suffix;
	public $Disjunctive;
	public $Image;
	
	public function Save(){
		$Conn = db();
		
		if ($this->getById($this->Id) != false ) {
			return false;
		}

		$stmt = $Conn->prepare($sql);		
		$sql = sprintf("INSERT INTO collections(
							id,
							handle,
							title,
							updated_at,
							published_at,
							body_html,
							sort_order,
							template_suffix,
							disjunctive,
							image
						) VALUES(?,?,?,?,?,?,?,?,?,?)");
				
		$stmt = $Conn->prepare($sql);
			$stmt->bind_param("ssssssssss", 
			$this->Id,
			$this->Handle,
			$this->Title,
			$this->Updated_at,
			$this->Published_at,
			$this->Body_html,
			$this->Sort_order,
			$this->Template_suffix,
			$this->Disjunctive,
			$this->Image
		);

		$stmt->execute();
	
		// debug($sql);	
	}

	private function getById($id){
		$Conn = db();
		
		$sql = sprintf("SELECT id FROM collections WHERE id = ?");
		$stmt = $Conn->prepare($sql);
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$value = $result->fetch_row()[0] ?? false;
		return $value;
	}
	
	public function getAll(){
	    $Conn = db();
		
		
		$sql = sprintf("SELECT title,image,handle, body_html FROM collections");
		$stmt = $Conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		
		return $data;
	}
	
}

