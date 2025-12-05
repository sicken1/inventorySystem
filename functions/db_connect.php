<?php
function get_connection()
{
	$servername = 'localhost';
	$dbname = 'inventory_db_markscent';
	$username = 'root';
	$password = '';

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		return $conn;
	} catch(PDOException $e) {
		echo 'Connection failed: '.$e->getMessage();
		die();
	}     
	echo $conn;
}

define('BASE_URL','http://localhost/inventory_markscent');

?>