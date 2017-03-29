<?php
    
/**FileName = SIGNUP.PHP
 * Description : this is signup page for todoist
 * STUEDENT NAME = RUTUL PATEL
 * STUDENT NUMBER : 200335158
 * AUTHOR NAME : RUTUL PATEL
 * WEBSITE : TODOIST
 * ASSIGNMENT 1 
 */
    session_start();
    include("connection.php");
    $error = 0;
 // this is post method for signup form to insert data in the database
    if (isset($_POST['signup'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username == "") 
            $error = 1;
        elseif ($password == "") 
            $error = 1;
        else {
//            Insert data into username and password in user table
            $query = "INSERT INTO users (username, password)
            VALUES ('$username', '$password')";

            if (mysqli_query($con, $query)) {

                $query = "SELECT * FROM users
                WHERE username = '$username' AND password = '$password'";

                $result = mysqli_query($con, $query);
                $row =  mysqli_fetch_assoc($result);
                // if user id and username is match from the database then send to todo.php
                $_SESSION["userid"] = $row["userid"];
                $_SESSION["username"] = $row["username"];
                header("Location: login.php");
            } 
            else
                $error = 1;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Todoist | Sign Up</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
<!-- This is custom css for specific GUI-->
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js  doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
<!-- CSS bootstrap container-->
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
			
				<div id="navbar" class="navbar-collapse collapse">					
					<ul class="nav navbar-nav navbar-right">
						<li><a href="login.php">Log In</a></li>
						<li class="active"><a href="signup.php">Sign Up</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="container">
            <div id="box">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Please Sign Up
                    </div>

                    <div class="panel-body">
                <!-- error code for the when code = 1 -->
                        <?php 
                            if ($error == 1) 
                                echo '<div class="alert alert-danger">Invalid Username or Password!</div>';
                        ?>
    
                        <form class="form-horizontal" method="POST" action="">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="username" placeholder="username">           
                            </div>
                                
                            <div class="input-group" style="margin-top: 15px;">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="password">
                            </div>

                            <div style="margin-top: 15px;">
                                <input type="submit" name="signup" class="btn btn-primary" value="Sign Up">
                            </div>
                        </form>
                    </div>
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