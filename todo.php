<?php
    
/**FileName = todo.php
 * Description : this is main page of todoist in this page we can see all the todo
 * STUEDENT NAME = RUTUL PATEL
 * STUDENT NUMBER : 200335158
 * AUTHOR NAME :  RUTUL PATEL
 * WEBSITE : TODOIST
 * ASSIGNMENT 1 
 */
    session_start();
    include("connection.php");

    $userid = $_SESSION["userid"];
    $username = $_SESSION["username"];

    if (isset($_POST['add'])) {
        $todoname = $_POST['todoname'];
        if ($todoname == "") 
            echo "Please Enter Todo" . mysqli_error($con);
        else {
            $query = "INSERT INTO todos (todoname, userid)
            VALUES ('$todoname', '$userid')";

            if (!mysqli_query($con, $query)) 
                echo "Error : " . mysqli_error($con);
        }
    }

    $query = "SELECT * FROM todos WHERE userid = '$userid'";
    $result = mysqli_query($con, $query);

?>

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
                        <li class="active"><a href="todo.php">All Todos</a></li>
						<li><a href="logout.php">Log Out</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="jumbotron">
			<h2>Hello, <?php echo $username; ?></h2>
			<p>Your Todos.</p>
		</div>
        
        <table class="table table-striped">
        <?php
            if (mysqli_num_rows($result) > 0) {
//                This while loop insert all the data of todo into the the table
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";  // tr start tag
                        $todoid = $row["todoid"];
                        if ($row["todostatus"] == 1) {
                            echo "<td><input type='checkbox' checked onclick='check(this);' id='$todoid' name='todostatus' value=''/></td>";
                            echo "<td><del>" . $row["todoname"] . "</del></td>";
                        }
                        else {
                            echo "<td><input type='checkbox' onclick='check(this);' id='$todoid' name='todostatus' value=''/></td>";
                            echo "<td>" . $row["todoname"] . "</td>";
                        }
                        echo "<td class='edit'><a href='edit.php?todoid=$todoid'><span class='glyphicon glyphicon-edit'></span> Edit</a></td>";
                    echo "</tr>";  // tr end tag
                }
            } else {
                echo "Nothing yet";
            }
        ?>
        </table>
        
        <form method="POST" action="">
            <div class="input-group">
                <input class="form-control" name="todoname" type="text" placeholder="Todo Name">
                <div class="input-group-btn">
                    <input class="btn btn-primary" name="add" type="submit" value="Add">
                </div>
            </div>
        </form>
        

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
<!-- java script for the checkbox onClick-->
    
    <script type="text/javascript">
        function check(checkbox)  {
            var id = $(checkbox).attr('id');
// check box status = 1 when check and status = 0 when uncheck
            if($(checkbox).is(":checked"))
                window.location.href = "status.php?todoid=" + id + "&status=1";
            else
                window.location.href = "status.php?todoid=" + id + "&status=0";
        }
    </script>

  </body>
</html>