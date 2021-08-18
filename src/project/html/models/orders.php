<?php 
require_once "utils.php";
require_once "dbconnection.php";

class Orders {
	
	public $Id;
	public $Contact_email;
	public $Created_at;
	public $Currency;
	public $Curent_subtotal_price;
	public $Customer_locale;
	public $Discount_codes;
	public $Email;
	public $Estimated_taxes;
	public $Financial_status;
	public $Fulfillment_status;
	public $Name;
	public $Note;
	public $Note_attributes;
	public $Number;
	public $Order_number;
	public $Order_status_url;
	public $Original_total_duties_set;
	public $Payment_gateway_names;
	public $Phone;
	public $Presentment_currency;
	public $Processed_at;
	public $Processing_method;
	public $Reference;
	public $Referring_site;
	public $Source_identifier;
	public $Source_name;
	public $Source_url;
	public $Subtotal_price;
	
	public function Save(){
		$Conn = db();
		
		if ($this->getById($this->Id) != false ) {
			return false;
		}

		
		$sql = sprintf("INSERT INTO orders(
				id,
				contact_email,
				created_at,
				currency,
				current_subtotal_price,
				customer_locale,
				discount_codes,
				email,
				estimated_taxes,
				financial_status,
				fulfillment_status,
				name,
				note,
				note_attributes,
				number,
				order_number,
				order_status_url,
				original_total_duties_set,
				payment_gateway_names,
				phone,
				presentment_currency,
				processed_at,
				processing_method,
				reference,
				referring_site,
				source_identifier,
				source_name,
				source_url,
				subtotal_price
		) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
				
		$stmt = $Conn->prepare($sql);
		$stmt->bind_param("sssssssssssssssssssssssssssss", 
			$this->Id,
			$this->Contact_email,
			$this->Created_at,
			$this->Currency,
			$this->Curent_subtotal_price,
			$this->Customer_locale,
			$this->Discount_codes,
			$this->Email,
			$this->Estimated_taxes,
			$this->Financial_status,
			$this->Fulfillment_status,
			$this->Name,
			$this->Note,
			$this->Note_attributes,
			$this->Number,
			$this->Order_number,
			$this->Order_status_url,
			$this->Original_total_duties_set,
			$this->Payment_gateway_names,
			$this->Phone,
			$this->Presentment_currency,
			$this->Processed_at,
			$this->Processing_method,
			$this->Reference,
			$this->Referring_site,
			$this->Source_identifier,
			$this->Source_name,
			$this->Source_url,
			$this->Subtotal_price
		);

		$stmt->execute();
	}

	private function getById($id){
		$Conn = db();
		
		$sql = sprintf("SELECT id FROM orders WHERE id = ?");
		$stmt = $Conn->prepare($sql);
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$value = $result->fetch_row()[0] ?? false;
		return $value;
	}
	
}

