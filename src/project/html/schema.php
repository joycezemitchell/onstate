<?php

require_once 'dbconnection.php';

class Schema {

	private $sql = array();

	public function __construct() {
		$this->sql[0] = "CREATE TABLE IF NOT EXISTS  collections (
			id VARCHAR(50) NOT NULL,
			handle VARCHAR(50),
			title VARCHAR(50),
			updated_at datetime,
			published_at datetime,
			body_html BLOB,
			sort_order VARCHAR(50),
			template_suffix VARCHAR(50),
			disjunctive VARCHAR(50),
			image VARCHAR(250)
		)";

		$sql[1] = "CREATE TABLE IF NOT EXISTS  products (
			id VARCHAR(50) NOT NULL,
			title VARCHAR(50),
			body_html BLOB,
			vendor VARCHAR(50),
			product_type VARCHAR(50),
			created_at datetime,
			updated_at VARCHAR(50),
			published_at VARCHAR(50),
			template_suffix VARCHAR(50),
			status VARCHAR(50),
			published_scope VARCHAR(50),
			tags VARCHAR(50),
			image VARCHAR(250)
		)";

		$this->sql[1] = "CREATE TABLE IF NOT EXISTS  products (
			id VARCHAR(50) NOT NULL,
			title VARCHAR(50),
			body_html BLOB,
			vendor VARCHAR(50),
			product_type VARCHAR(50),
			created_at datetime,
			updated_at VARCHAR(50),
			published_at VARCHAR(50),
			template_suffix VARCHAR(50),
			status VARCHAR(50),
			published_scope VARCHAR(50),
			tags VARCHAR(50),
			image VARCHAR(250)
		)";


		$this->sql[2] = "CREATE TABLE IF NOT EXISTS orders (
			id  VARCHAR(50) NOT NULL,
			contact_email  VARCHAR(50),
			created_at VARCHAR(50),
			currency VARCHAR(50),
			current_subtotal_price VARCHAR(50),
			customer_locale VARCHAR(50),
			discount_codes VARCHAR(50),
			email VARCHAR(50),
			estimated_taxes VARCHAR(50),
			financial_status VARCHAR(50),
			fulfillment_status VARCHAR(50),
			name VARCHAR(50),
			note VARCHAR(50),
			note_attributes VARCHAR(50),
			number VARCHAR(50),
			order_number VARCHAR(50),
			order_status_url VARCHAR(250),
			original_total_duties_set VARCHAR(50),
			payment_gateway_names VARCHAR(50),
			phone VARCHAR(50),
			presentment_currency VARCHAR(50),
			processed_at VARCHAR(50),
			processing_method VARCHAR(50),
			reference VARCHAR(50),
			referring_site VARCHAR(50),
			source_identifier VARCHAR(50),
			source_name VARCHAR(50),
			source_url VARCHAR(50),
			subtotal_price VARCHAR(50)
		)";

		$Conn = db();
		
		foreach($this->sql as $q) {
			$Conn->query($q);
		}
	}
		
}


