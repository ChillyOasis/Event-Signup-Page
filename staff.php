<!DOCTYPE HTML>
<html>
<head>
  <title>Configure UOW Event table</title>
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
<form action="insert.php" method="POST">
<tr>
<td>Event name:</td>
<td><input type="text" name="name" required></td>
</tr>
<tr>
<td>Description:</td>
<td><input type="text" name="description" required></td>
</tr>
<tr>
<td>Date & Time:</td>
<td><input type="datetime-local" name="date" required></td>
</tr>
<tr>
<td>Participants:</td>
<td><input type="text" name="participants" required></td>
</tr>
<tr>
<td>Cost:</td>
<td><input type="text" name="cost" required></td>
</tr>
<tr>
<td><input type="submit" value="Submit"></td>
</tr>
</form>
   <tr>
   <th>Event name</th>
   <th>Description</th>
   <th>Date & time</th>
   <th>Participants</th>
   <th>Cost</th>
   </tr>
   <?php
   $conn = mysqli_connect("localhost", "root", "", "event");
   if ($conn-> connect_error) {
	   die ("Connection failed:". $conn-> connect_error);
   }
   $sql = "SELECT id, name, description, date, participants, cost FROM createevent";
   $result = $conn-> query($sql);
   
   if ($result-> num_rows > 0) {
	   while ($row = $result-> fetch_assoc()) {
		   
		   echo "<tr><td>".$row["name"]."</td>
					 <td>".$row["description"]."</td>
					 <td>".$row["date"]."</td>
					 <td>".$row["participants"]."</td>
					 <td>".$row["cost"]."</td><td>";
			
			$id = $row["id"];
		   
		   echo "<form action='update.php' method='POST'>";
		   echo "<input type='hidden' name='id' value='$id'>";
		   echo "<td><input type='submit' value='Update'></td></form>";
		   
		   echo "<form action='delete.php' method='POST'>";
		   echo "<input type='hidden' name='id' value='$id'>";
		   echo "<td><input type='submit' value='Delete'></td></form>";
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