<?php
$id = $_POST['id'];

if (!empty($id)) {	
    $host = "localhost";
	$dbUsername = "root";
	$dbdescription = "";
	$dbname = "login";
	
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbdescription, $dbname);
    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
        } else {
			$sql = "DELETE FROM users WHERE id = $id";

			if (mysqli_query($conn, $sql)) {
				echo "User has been deleted ";
				echo "<a href=admin.php>Back</a>";
			} else {
				echo "Deletion failed";
			}
        }
    } else {
     echo "All field are required";
     die();
    }
?>