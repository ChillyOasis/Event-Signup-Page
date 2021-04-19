<?php
$user_id = $_POST['user'];
$name = $_POST['name'];
$cost = $_POST['cost'];
$quantity = $_POST['quantity'];

if (!empty($name)) {
	$host = "localhost";
	$dbUsername = "root";
	$dbdescription = "";
	$dbname = "event";
	//create connection
	$conn = new mysqli($host, $dbUsername, $dbdescription, $dbname);
	if (mysqli_connect_error()) {
	 die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
	} else {
	 $SELECT = "SELECT name From joinevent Where name = ?";
	 $INSERT = "INSERT Into joinevent (user_id, name, cost, quantity) values(?, ?, ?, ?)";
	 //Prepare statement
	 $stmt = $conn->prepare($SELECT);
	 $stmt->bind_param("s", $user_id);
	 $stmt->execute();
	 $stmt->bind_result($user_id);
	 $stmt->store_result();
	 $rnum = $stmt->num_rows;
	 if ($rnum==0) {
	  $stmt->close();
	  $stmt = $conn->prepare($INSERT);
	  $stmt->bind_param("isii", $user_id, $name, $cost, $quantity);
	  $stmt->execute();
	  echo "You joined the event! ";
	  echo "<a href=student.php?user=$user_id>Back</a>";
	 } else {
	  echo "Error occured";
	 }
	 $stmt->close();
	 $conn->close();
	}
} else {
 echo "Missing event name";
 die();
}
?>