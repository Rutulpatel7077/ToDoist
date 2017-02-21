
<?php


/** FileName = Connection.PHP
 *	Description : this is common connection file for all pages.
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

	$con = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
?>