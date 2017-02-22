<?php


/**  FileName = Edit.PHP
 *	Description :  this is edit page for the todoist this page will edit todonotes in the database.
 * 	STUEDENT NAME = RUTUL PATEL
 * 	STUDENT NUMBER : 200335158
 * 	AUTHOR NAME : RUTUL PATEL
 * 	WEBSITE : TODOIST
 * 	ASSIGNMENT 1 
 */


	session_start();
	include("connection.php");  // this is for connection with databse.
	$error = 0;

	$userid = $_SESSION["userid"];    // get user id for session log in
	$todoid = $_GET['todoid'];
	$username = $_SESSION["username"];

	// this is query for databse to get data  for the user
	$query = "SELECT * FROM todos     
	WHERE userid = '$userid' AND todoid = '$todoid'";
	$result = mysqli_query($con, $query);


	if (mysqli_num_rows($result) > 0) 
		$row =  mysqli_fetch_assoc($result);
	else
		echo "Error!";
     // when edit button is pressed update database for todoname and todonotes
	if (isset($_POST['edit'])) {
		$todoname = $_POST['todoname'];
		$todonotes = $_POST['todonotes'];
    // display error if todoname or todonotes name is empty
		if ($todoname == "") 
			$error = 1;
		elseif ($todonotes == "") 
			$error = 1;
		else {
			$query = "UPDATE todos SET todoname = '$todoname'
			WHERE userid = '$userid' AND todoid = '$todoid'";
            // header for location todonotes.php
			if (mysqli_query($con, $query)) 
				header("Location: todo.php");
			else
				echo "Error : " . mysqli_error($con);

			$query = "UPDATE todos SET todonotes = '$todonotes'
			WHERE userid = '$userid' AND todoid = '$todoid'";

			if (mysqli_query($con, $query)) 
				header("Location: todo.php");
			else
				echo "Error : " . mysqli_error($con);
		}
	}
    // if delete button press  this is isset for delete query for database
	if (isset($_POST['delete'])) {
		$query = "DELETE FROM todos
		WHERE userid = '$userid' AND todoid = '$todoid'";

		if (mysqli_query($con, $query))
			header("Location: todo.php");
		else
			echo "Error : " . mysqli_error($con);
	}

?>

<!--html GUI for index-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Todoist | Todo</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
<!--bootstrrap css design -->
    <div class="container">
		<div class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
            		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">Todoist</a>
				</div>
        <!--nav bar for all pages-->
				<div id="navbar" class="navbar-collapse collapse">					
					<ul class="nav navbar-nav navbar-right">
						<li><a href="todo.php">All Todos</a></li>
						<li><a href="logout.php">Log Out</a></li>
					</ul>
				</div>
			</div>
		</div>
        
        <div class="editor">
        	<?php 
                if ($error == 1) 
                    echo '<div class="alert alert-danger">Oops! Empty todo.</div>';
            ?>

        	<div class="row">
        		<div class="col-md-9">
            <!-- this is form to save all todonotes and todoname -->
		        	<form method="POST" action="">
			            <input name="todoname" type="text" class="form-control" value="<?php echo $row['todoname']; ?>">  
			            <textarea name="todonotes" class="form-control" rows="4"><?php echo $row['todonotes']; ?></textarea>  
			            <input name="edit" class="btn btn-primary" type="submit" value="Edit">       
			        </form>
			    </div>
			    <div class="col-md-3">
			        <form class="form-inline" method="POST" action=""> 
						<input name="delete" class="btn btn-danger" type="submit" value="Delete">
					</form>
					<a class="btn btn-warning" href="todo.php">Cancel</a>
				</div>
			</div>
        </div>        

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>