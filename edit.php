<!DOCTYPE HTML>
<html>
<head>
  <title>Update UOW Event</title>
</head>
<body>
  <table>
  <style>
	table {
	border-collapse: collapse;
	width: 100%;
	color: #588c7e;
	font-family: monospace;
	font-size: 15px;
	text-align: left;
	}
	th {
	background-color: #588c7e;
	color: white;
	}
	tr:nth-child(even) {background-color: #f2f2f2}
	</style>
<?php
$user_id = $_POST['user'];
$id = $_POST['id'];

if (!empty($id)) {	
    $host = "localhost";
	$dbUsername = "root";
	$dbdescription = "";
	$dbname = "event";
	
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbdescription, $dbname);
    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
        } else {
			$sql = "SELECT quantity FROM joinevent WHERE id = $id";
			$result = $conn-> query($sql);

			if ($result-> num_rows > 0) {
				while ($row = $result-> fetch_assoc()) {
				echo "<form action=edit1.php method=POST>";
				echo "<input type='hidden' name='user' value='$user_id'>";
				echo "<input type='hidden' name='id' value='$id'>";
				echo "<tr><td>Quantity of tickets:</td><td><input type='number' name='quantity' value='".$row['quantity']."' min=1></td></tr>";
				echo "<tr><td><input type='submit' value='Update'></td></form>";
				
				echo "<form action=leave.php method=POST>";
				echo "<input type='hidden' name='user' value='$user_id'>";
				echo "<input type='hidden' name='id' value='$id'>";
				echo "<td><input type='submit' value='Leave'></td></form></tr>";
				}
			} else {
				echo "Event ID not found in database";
			}
        }
    } else {
     echo "Error occurred";
     die();
    }
?>
  </table>
</body>
</html>