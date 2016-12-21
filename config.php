<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="test"; // Database name 
	$mysqli = new mysqli($host, $username, $password, $db_name); 
	if($mysqli->connect_error) {
			die('Connect Error: ' . $mysqli->connect_error);
		}
	$mysqli->query("SET NAMES utf8");