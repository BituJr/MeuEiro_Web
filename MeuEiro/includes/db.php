<?php

error_reporting(0);
ini_set('display_errors', '0');

$dbuser="root";		
$dbpassword=""; 	
$dbname="meueiro";
$dbhost="localhost";

$mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
if (mysqli_connect_errno()) {
	printf("MySQLi connection failed: ", mysqli_connect_error());
	exit();
}

if (!$mysqli->set_charset('utf8')) {
	printf('Error loading character set utf8: %s\n', $mysqli->error);
}

?>
