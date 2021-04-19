<!DOCTYPE HTML>
<html>
<head>
  <title>Update UOW Event</title>
</head>
<body>
  <table cellpadding="3">
  <style>
	table {
	border-collapse: collapse;
	width: 100%;
	color: #588c7e;
	font-size: 15px;
	text-align: left;
	}
	th {
	font-size: 20px;
	background-color: #588c7e;
	color: white;
	}
	tr:nth-child(even) {background-color: #f2f2f2}
	</style>
<?php
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
			$sql = "SELECT name, description, date, participants FROM createevent WHERE id = $id";
			$result = $conn-> query($sql);

			if ($result-> num_rows > 0) {
				while ($row = $result-> fetch_assoc()) {
				echo "<tr><form action=update1.php method=POST>";
				
				echo "<input type='hidden' name='id' value='$id'>";
				echo "<tr><td>Event name:</td><td><input type='text' name='name' value='".$row['name']."'></td></tr>";
				echo "<tr><td>Description:</td><td><input type='text' size='50' name='description' value='".$row['description']."'></td></tr>";
				echo "<tr><td>Date:</td><td><input type='text' name='date' value='".$row['date']."'></td></tr>";
				echo "<tr><td>Participants:</td><td><input type='text' name='participants' value='".$row['participants']."'></td></tr>";
				
				echo "<tr><td><input type='submit' value='Update'></td></tr>";
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