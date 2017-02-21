<?php
	
/** FileName = LOGOUT.PHP
 *	Description :  this is logout page of todoist 
 * STUEDENT NAME = RUTUL PATEL
 * STUDENT NUMBER : 200335158
 * AUTHOR NAME : RUTUL PATEL
 * WEBSITE : TODOIST
 * ASSIGNMENT 1 
 */

	session_start();
	session_unset();
	header("Location:index.php");
?>