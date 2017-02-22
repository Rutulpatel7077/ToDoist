<?php
	
/** FileName = status.php
 *	Description : this page will update all the todo status specially checkbox into database  todoist
 * STUEDENT NAME = RUTUL PATEL
 * STUDENT NUMBER : 200335158
 * AUTHOR NAME : RUTUL PATEL
 * WEBSITE : TODOIST
 * ASSIGNMENT 1 
 */

	session_start();
	include("connection.php");
	$error = 0;

	$userid = $_SESSION["userid"];
	$todoid = $_GET['todoid'];
	$status = $_GET['status'];
	$username = $_SESSION["username"];

	$query = "SELECT * FROM todos 
	WHERE userid = '$userid' AND todoid = '$todoid'";
	$result = mysqli_query($con, $query);

	if (mysqli_num_rows($result) > 0) 
		$row =  mysqli_fetch_assoc($result);
	else
		echo "Error!";
    // this update query will update database onClick to the checkbox
	if ($status == "1")  {
		$query = "UPDATE todos SET todostatus = 1
		WHERE userid = '$userid' AND todoid = '$todoid'";

		if (mysqli_query($con, $query)) 
			header("Location: todo.php");
		else
			echo "Error : " . mysqli_error($con);	
	}
	elseif ($status == "0") {
		$query = "UPDATE todos SET todostatus = 0
		WHERE userid = '$userid' AND todoid = '$todoid'";

		if (mysqli_query($con, $query)) 
			header("Location: todo.php");
		else
			echo "Error : " . mysqli_error($con);
	}

?>