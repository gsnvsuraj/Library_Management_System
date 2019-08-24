<!DOCTYPE html>
<html>
<head>
	<title>List</title>

	<style type="text/css">
		#students {
  border-collapse: collapse;
  width: 60%;
  text-align: center;
  font-size: 18px;
}

#students td, #students th {
  border: 1px solid #ddd;
  padding: 8px;
}

#students tr:nth-child(even){background-color: #f2f2f2;}

#students tr:hover {background-color: #ddd;}

#students th {
  padding-top: 12px;
  padding-bottom: 12px;
  background-color: #4CAF50;
  color: white;
  font-size: 20px;
}

.button{
				background-color: #008CBA;
				border: none;
				color: white;
				padding: 12px 28px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				margin: 4px 2px;
				cursor: pointer;
			}

			ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
    font-size: 20px;
  }

  li {
    float: left;
  }

  li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }

  li a:hover {
    background-color: #111;
  }

  .active {
      background-color: #4CAF50;
  }
	</style>
</head>
<body>
	<ul>
    <li><img src="http://nitpy.ac.in/wp-content/uploads/2016/04/logomin.png" height=50px width=50px></img></li>
    <li><a class="college">NIT Puducherry Library</a></li>
      <li><a href="select.html">Home</a></li>
      <li><a class="active" href="list.php">List</a></li>
      <li><a href="listAdd.php">Add</a></li>
      <li><a href="listRet.php">Return</a></li>
      <li style="float:right"><a href="logout.php">Log Out</a></li>
  </ul>
	<div>
		<center><h1>Books List</h1></center>
	</div>

	<div>
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "library";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}

			session_start();

			echo "<h2><center>Your Taken Books List is</center></h2>";

			$sql = "SELECT * FROM assign WHERE user = '".$_SESSION['user']."';";
			$res = $conn->query($sql) or die(mysqli_error($conn));

			if(mysqli_num_rows($res) > 0){
    			echo "<table align='center' id='students' ><tr><th>Book ID</th><th>Name</th><th>Author</th></tr>";
    			while($row = mysqli_fetch_array($res)) {
        			echo "<tr><td>".$row['id']."</td>";

        			$sql = "SELECT * FROM books WHERE id = '".$row['id']."';";
        			$res1 = $conn->query($sql) or die(mysqli_error($conn));
        			$row1 = mysqli_fetch_array($res1);

        			echo "<td>".$row1['name']."</td><td>".$row1['author']."</td></tr>";
			    }
			    echo "</table>";
			}
			else{
				echo "<center><h4>No Books taken by you.</h4></center>";
			}
		?>
	</div>
</body>
</html>