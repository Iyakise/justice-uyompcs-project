<?php 
	if(!defined('__mpc_connection__')) {
		die("<h1> Access denied.</h1>");
	}

function __mpcConn__() {
	//collectiing database information
	$host = "localhost";
	$username = "root";
	$password = "";
	$db = "justice";

	//trying to intialize connection to db
	$conn = new mysqli($host, $username, $password, $db);

	//checking to make sure database connection success
	if(!$conn) {
		exit('Database connection failed' .mysqli_error($conn));
	}

	return $conn;

}

	$conn = __mpcConn__();