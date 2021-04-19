<?php
	// connect to the server and select database
	$con=mysqli_connect("localhost", "root", "", "login");
	
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	// get values passed from login.php
	$username = $_POST['username'];
	$password = $_POST['password'];

	// to prevent mysql injection
	$username = stripcslashes($username);
	$password = stripcslashes($password);
	$username = mysqli_real_escape_string($con, $username);
	$password = mysqli_real_escape_string($con, $password);

	// Query the database for user
	$result = mysqli_query($con, "SELECT * FROM users WHERE username = '$username' AND password = '$password'") 
			  or die ("Failed to query database ".mysqli_connect_error());
	$row = mysqli_fetch_array($result);
	if ($row['username'] == $username && $row['password'] == $password) {
		$user = $row['id'];
		if ($row['usertype'] == "staff") {
			header("Location: http://localhost/uowphp/staff.php");
		}
		else if ($row['usertype'] == "student") {
			header("Location: http://localhost/uowphp/student.php?user=".$user);
		}
		else if ($row['usertype'] == "admin") {
			header("Location: http://localhost/uowphp/admin.php");
		}
	} else {
		echo "Login failed, check if username and password are correct";
	}
?>