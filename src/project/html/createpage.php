<?php 
require_once 'apiconnection.php';
require_once 'utils.php';
require_once 'models/collections.php';

// Grab all collections
$collections = new Collections();
$data = $collections->getAll();

// Convert to html
$html = convertToHtml($data);
echo $html;

// Send to shopify
sendToShopify($html);

function convertToHtml($data) {
	foreach($data as $d) {
		$html .= sprintf('
			<li>
				<a href="https://chris-r-plus-sandbox.myshopify.com/collections/%s"><img style="max-height:100px" src="%s" /></a>
				<a href="%s"><div>%s</div></a>
			<li>
		', $d['handle'], $d['image'], $d['handle'], $d['title']);
		
	}

	$html_main = sprintf("<ul>%s</ul>", $html);

	return $html_main;
	
}

function sendToShopify($html){
	$page = array();
	$page["title"] = "Sample Exam Page";
	$page["body_html"] = $html;
	$json = json_encode($page);
	$response = postAdminResoure('page.json', $json);
	return $response;	
}