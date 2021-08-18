<?php 
require_once "utils.php";
require_once "dbconnection.php";

class Products {
	
    public $Id;
    public $Title;
    public $Body_html;
    public $Vendor;
    public $Product_type;
    public $Created_at;
    public $Updated_at;
    public $Published_at;
    public $Eemplate_suffix;
    public $Status;
    public $Published_scope;
	public $Tags;
    public $Image;
	
	public function Save(){
		$Conn = db();
		
		if ($this->getById($this->Id) != false ) {
			return false;
		}
		
		$sql = sprintf("INSERT INTO products(
					id,
					title,
					body_html,
					vendor,
					product_type,
					created_at,
					updated_at,
					published_at,
					template_suffix,
					status,
					published_scope,
					tags,
					image
			    ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
				
		$stmt = $Conn->prepare($sql);
		$stmt->bind_param("sssssssssssss", 
			$this->Id,
			$this->Title,
			$this->Body_html,
			$this->Vendor,
			$this->Product_type,
			$this->Created_at,
			$this->Updated_at,
			$this->Published_at,
			$this->Template_suffix,
			$this->Status,
			$this->Published_scope,
			$this->Tags,
			$this->Image
		);

		$stmt->execute();	
	}

	private function getById($id){
		$Conn = db();
		
		$sql = sprintf("SELECT id FROM products WHERE id = ?");
		$stmt = $Conn->prepare($sql);
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$value = $result->fetch_row()[0] ?? false;
		return $value;
	}
	
}

