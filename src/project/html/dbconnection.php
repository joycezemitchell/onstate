<?php
require_once("config.php");

function db() {
    $servername = SERVERNAME;
	$username = USERNAME;
	$password = PASSWORD;
	$dbname = DATABASE;

	static $conn;
    if ($conn===NULL){ 
        $conn = new mysqli($servername, $username, $password, $dbname);
    }
    return $conn;
}

