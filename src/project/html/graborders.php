<?php 

require_once('utils.php');
require_once('apiconnection.php');
require_once('models/orders.php');

class GrabOrders {
	
	function __construct() {
		debug("Importing Orders");

		/* GRAB ALL PRODUCTS */

		$response = getAdminResoure('orders.json?status=any');
		$data  = json_decode($response);
		$this->saveCollection($data->orders); 
	}

	private function saveCollection($data) {
		foreach($data as $r) {
			debug($r->id);
		
			$timestamp = strtotime($r->created_at);
			$created_at = date("Y-m-d H:i:s", $timestamp);
			
			$orders  = new Orders();
			$orders->Id = $r->id;
			$orders->Contact_email = $r->contact_email;
			$orders->Created_at = $created_at;
			$orders->Currency = $r->currency;
			$orders->Curent_subtotal_price = $r->curent_subtotal_price;
			$orders->Customer_locale = $r->customer_locale;
			$orders->Discount_codes = $r->discount_codes;
			$orders->Email = $r->email;
			$orders->Estimated_taxes = $r->estimated_taxes;
			$orders->Financial_status = $r->financial_status;
			$orders->Fulfillment_status = $r->fulfillment_status;
			$orders->Name = $r->name;
			$orders->Note = $r->note;
			$orders->Note_attributes = $r->note_attributes;
			$orders->Number = $r->number;
			$orders->Order_number = $r->order_number;
			$orders->Order_status_url = $r->order_status_url;
			$orders->Original_total_duties_set = $r->original_total_duties_set;
			$orders->Payment_gateway_names = $r->payment_gateway_names;
			$orders->Phone = $r->phone;
			$orders->Presentment_currency = $r->presentment_currency;
			$orders->Processed_at = $r->processed_at;
			$orders->Processing_method = $r->processing_method;
			$orders->Reference = $r->reference;
			$orders->Referring_site = $r->referring_site;
			$orders->Source_identifier = $r->source_identifier;
			$orders->Source_name = $r->source_name;
			$orders->Source_url = $r->source_url;
			$orders->Subtotal_price = $r->subtotal_price;

			$orders->Save();	
		}
	}



}

