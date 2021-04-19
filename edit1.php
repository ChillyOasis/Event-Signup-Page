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
		$sql = "UPDATE joinevent SET quantity='$_POST[quantity]' WHERE id = $id";

			if (mysqli_query($conn, $sql)) {
				echo "Event has been updated ";
				echo "<a href=student.php?user=$user_id>Back</a>";
			} else {
				echo "Update failed";
			}
        }
    } else {
     echo "Update error";
     die();
    }
?>