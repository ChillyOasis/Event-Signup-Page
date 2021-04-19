<!DOCTYPE HTML>
<html>
<head>
  <title>Create or view users</title>
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
<tr>
<button onclick="window.location.href='login.php'">Logout</button>
</tr>
<form action="users.php" method="POST">
<tr>
<td>Username:</td>
<td><input type="text" name="username" required></td>
</tr>
<tr>
<td>Password:</td>
<td><input type="password" name="password" required></td>
</tr>
<tr>
<td>User type:</td>
<td>
<select name="usertype">
  <option value="student">Student</option>
  <option value="staff">Staff</option>
  <option value="admin">Admin</option>
</select> 
</td>
</tr>
<td><input type="submit" value="Submit"></td>
</form>
   <tr>
   <th>ID</th>
   <th>Username</th>
   <th>User type</th>
   <th>Last login</th>
   </tr>
   <?php
   $conn = mysqli_connect("localhost", "root", "", "login");
   if ($conn-> connect_error) {
	   die ("Connection failed:". $conn-> connect_error);
   }
   $sql = "SELECT id, username, usertype, lastlogin FROM users";
   $result = $conn-> query($sql);
   
   if ($result-> num_rows > 0) {
	   while ($row = $result-> fetch_assoc()) {
		   echo "<tr><td>".$row["id"]."</td>
					 <td>".$row["username"]."</td>
					 <td>".$row["usertype"]."</td>
					 <td>".$row["lastlogin"]."</td><td>";
					 
		   $id = $row["id"];
		   
		   echo "<form action='delusers.php' method='POST'>";
		   
		   echo "<input type='hidden' name='id' value='$id'>";
		   echo "<input type='submit' value='Delete'></form>";
	   }
	}
	else {
		echo "<tr><td>No users</td></tr>";
	}
	
	echo "<tr>";
    echo "<th>User ID</th>";
    echo "<th>Event joined</th>";
	echo "<th>Tickets purchased</th>";
	echo "<th></th>";
    echo "</tr>";
   
	$conn = mysqli_connect("localhost", "root", "", "event");
	if ($conn-> connect_error) {
	   die ("Connection failed:". $conn-> connect_error);
	}
    $sql = "SELECT id, user_id, name, quantity FROM joinevent";
    $result = $conn-> query($sql);
   
    if ($result-> num_rows > 0) {
	    while ($row = $result-> fetch_assoc()) {
	 	   echo "<tr><td>".$row["user_id"]."</td>
					 <td>".$row["name"]."</td>
					 <td>".$row["quantity"]."</td><td>";
	    }
	 }
	 else {
		echo "<tr><td>No users has joined an event</td></tr>";
	 }
	$conn-> close();
	?>
</table>
</body>
</html>