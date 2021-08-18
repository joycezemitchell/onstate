<?php 

require_once('utils.php');
require_once('apiconnection.php');
require_once('models/products.php');

class GrabProducts {
	
	function __construct() {
		debug("Importing Products");

		/* GRAB ALL PRODUCTS */
		$response = getAdminResoure('products.json');
		$data  = json_decode($response);
		$this->saveCollection($data->products); 		
	}


	private function saveCollection($data) {
		
		foreach($data as $r) {
			//debug($r);
			
			debug($r->title);
			
			$timestamp = strtotime($r->created_at);
			$created_at = date("Y-m-d H:i:s", $timestamp);
			
			$timestamp = strtotime($r->updated_at);
			$updated_at = date("Y-m-d H:i:s", $timestamp);
			
			$timestamp = strtotime($r->published_at);
			$published_at = date("Y-m-d H:i:s", $timestamp);
			
			$products  = new Products();
			$products->Id = $r->id;
			$products->Title = $r->title;
			$products->Body_html = $r->body_html;
			$products->Vendor = $r->vendor;
			$products->Product_type = $r->product_type;
			$products->Created_at = $created_at;
			$products->Updated_at = $updated_at;
			$products->Published_at = $published_at;
			$products->Template_suffix = $r->template_suffix;
			$products->Status = $r->status;
			$products->Published_scope = $r->published_scope;
			$products->Tags = $r->tags;
			$products->Image = $r->image->src;	
			$products->Save();	
		}
	}
	
}

