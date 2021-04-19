<!DOCTYPE HTML>
<html>
<head>
  <title>UOW Event Registration Login</title>
</head>
<body>
 <form action="process.php" method="POST">
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
	<td>Username:</td>
	<td><input type="text" id="username" name="username" /></td>
   </tr>
   <tr>
	<td>Password:</td>
	<td><input type="password" id="password" name="password" /></td>
   </tr>
   <tr>
	<td><input type="submit" id="btn" value="Login" /></td>
   </tr>
   </form>
   <tr>
   <th>Event name</th>
   <th>Description</th>
   <th>Date & time</th>
   </tr>
   <?php
   $conn = mysqli_connect("localhost", "root", "", "event");
   if ($conn-> connect_error) {
	   die ("Connection failed:". $conn-> connect_error);
   }
   $sql = "SELECT name, description, date FROM createevent";
   $result = $conn-> query($sql);
   
   if ($result-> num_rows > 0) {
	   while ($row = $result-> fetch_assoc()) {
		   echo "<tr><td>".$row["name"]."</td>
					 <td>".$row["description"]."</td>
					 <td>".$row["date"]."</td><td>";
	   }
	}
	else {
		echo "No events";
	}
	$conn-> close();
	?>
  </table>
 </form>
</body>
</html>