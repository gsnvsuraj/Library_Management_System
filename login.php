<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css">
		ul {
		  list-style-type: none;
		  margin: 0;
		  padding: 0;
		  overflow: hidden;
		  background-color: #333;
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
		  font-weight: bold;
		  font-size: 20px;
		  cursor: pointer;
		}

		li a:hover:not(.active) {
		  background-color: #111;
		}
	</style>
</head>
<body>

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
//echo "Connected successfully";

session_start();

$sql = "SELECT * FROM login";
$result = $conn->query($sql);

$user = $_POST["user"];
$pass = $_POST["pass"];

if ($result->num_rows > 0) {
    // output data of each row
    $found = FALSE;
    while($row = $result->fetch_assoc()) {
        if($user == $row["user"]) {
            $found = TRUE;
        	if($pass == $row["password"]) {
        		$_SESSION["user"] = $row["user"];
        		header("Location:select.html");
        	}
        	else {
        		echo "\n<h3>Login unsuccessful, ".$user."<br>Incorrect Password</h3>";
        	}
        	break;
        }
    }
    if( $found == FALSE ) {
    	echo "\n<h3>Invalid User</h3>";
    }

} else {
    echo "0 results";
}
$conn->close();
?>
</body>
</html>