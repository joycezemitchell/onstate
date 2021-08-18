<?php
require_once("config.php");


function getAdminResoure($resource){
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://chris-r-plus-sandbox.myshopify.com/admin/api/2021-07/' . $resource,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	  CURLOPT_HTTPHEADER => array(
		'Content-Type: application/json',
		'Authorization: Basic ' . APIKEY,
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	
	return $response;
	
}

function postAdminResoure($resource, $json){
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://chris-r-plus-sandbox.myshopify.com/admin/api/2021-07/' . $resource,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>$json,
	  CURLOPT_HTTPHEADER => array(
		'Content-Type: application/json',
		'Authorization: Basic ' . APIKEY,
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	return $response;
}