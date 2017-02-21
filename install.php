<?php

/** FileName = INSTALL.PHP
	Description :  Please run install.php before run the any page it will make database for you!
 * STUEDENT NAME = RUTUL PATEL
 * STUDENT NUMBER : 200335158
 * AUTHOR NAME : RUTUL PATEL
 * WEBSITE : TODOIST
 * ASSIGNMENT 1 
 */





	$dbname = "todo";
	$dbhost = "ca-cdbr-azure-central-a.cloudapp.net";
	$dbuser = "b7ac6c4de821d9";
	$dbpassword = "405a0809";

	$con = mysqli_connect($dbhost, $dbuser, $dbpassword);

	$query = "CREATE DATABASE IF NOT EXISTS " . $dbname;
	
	if (mysqli_query($con, $query)) 
		echo "Database created successfully";
	else
		echo "Error creating database: " . mysqli_error($con);

	mysqli_select_db($con, $dbname);

	$query = "CREATE TABLE IF NOT EXISTS users (
		userid INT NOT NULL AUTO_INCREMENT,
		username VARCHAR(20) NOT NULL,
		password VARCHAR(20) NOT NULL,
		PRIMARY KEY (userid)
	)";

	if (mysqli_query($con, $query)) 
		echo "<br>-- User Table created successfully";
	else
		echo "<br>Error creating database: " . mysqli_error($con);

	$query = "CREATE TABLE IF NOT EXISTS todos (
		todoid INT NOT NULL AUTO_INCREMENT,
		userid INT NOT NULL,
		todoname VARCHAR(255) NOT NULL,
		todonotes VARCHAR(255) DEFAULT NULL,
		todostatus BOOLEAN DEFAULT 0,
		PRIMARY KEY (todoid)
	)";

	if (mysqli_query($con, $query)) 
		echo "<br>--  Todo Table created successfully";
	else
		echo "<br>Error creating database: " . mysqli_error($con);

?>