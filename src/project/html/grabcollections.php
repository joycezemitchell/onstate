<?php 

require_once('utils.php');
require_once('apiconnection.php');
require_once('models/collections.php');


class GrabCollection {
	
	function __construct() {
		debug("Importing Collections");

		/* GRAB ALL SMART COLLECTIONS */

		$response = getAdminResoure('smart_collections.json');
		$data  = json_decode($response);
		$data = $data->smart_collections;
		$this->saveCollection($data); 

		/* GRAB ALL CUSTOM COLLECTIONS */
		$response = getAdminResoure('custom_collections.json');
		$data  = json_decode($response);
		$data = $data->custom_collections; 
		$this->saveCollection($data); 

	}

	private function saveCollection($data) {
			foreach($data as $r) {
				debug($r->title);
				
				$timestamp = strtotime($r->updated_at);
				$updated_at = date("Y-m-d H:i:s", $timestamp);
				
				$timestamp = strtotime($r->published_at);
				$published_at = date("Y-m-d H:i:s", $timestamp);
				
				$collection  = new Collections();
				$collection->Id = $r->id; 
				$collection->Handle = $r->handle; 
				$collection->Title = $r->title; 
				$collection->Updated_at = $updated_at; 
				$collection->Published_at = $published_at; 
				$collection->Body_html = $r->body_html; 
				$collection->Sort_order = $r->sort_order; 
				$collection->Template_suffix = $r->template_suffix; 
				$collection->Disjunctive = $r->disjunctive; 
				$collection->Image = $r->image->src; 
				
				$collection->Save();	
			}
		}
	
}



