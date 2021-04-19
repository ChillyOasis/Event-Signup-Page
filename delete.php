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
			$sql = "DELETE FROM createevent WHERE id = $id";

			if (mysqli_query($conn, $sql)) {
				echo "Event has been deleted ";
				echo "<a href=staff.php>Back</a>";
			} else {
				echo "Deletion failed";
			}
        }
    } else {
     echo "All field are required";
     die();
    }
?>