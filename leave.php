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
			$sql = "DELETE FROM joinevent WHERE id = $id";

			if (mysqli_query($conn, $sql)) {
				echo "You have left the event ";
				echo "<a href=student.php?user=$user_id>Back</a>";
			} else {
				echo "Leave failed";
			}
        }
    } else {
     echo "All field are required";
     die();
    }
?>