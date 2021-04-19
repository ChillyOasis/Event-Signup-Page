<!DOCTYPE HTML>
<html>
<head>
  <title>Book a UOW Event</title>
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
   <tr>
   <th>Event name</th>
   <th>Description</th>
   <th>Date & time</th>
   <th>Cost</th>
   <th>Quantity</th>
   </tr>
   <?php
   $user = $_GET['user'];
   $conn = mysqli_connect("localhost", "root", "", "event");
   if ($conn-> connect_error) {
	   die ("Connection failed:". $conn-> connect_error);
   }
   $sql = "SELECT id, name, description, date, cost FROM createevent";
   $result = $conn-> query($sql);
   
   $sqlcheck = "SELECT id, user_id, name, quantity FROM joinevent WHERE user_id = '$user'";
   
   if ($result-> num_rows > 0) {
	   while ($row = $result-> fetch_assoc()) {
		   echo "<tr><td>".$row["name"]."</td>
					 <td>".$row["description"]."</td>
					 <td>".$row["date"]."</td>
					 <td>", "$".$row["cost"]."</td>";
		   
		   $id = $row["id"];
		   $name = $row["name"];
		   $cost = $row["cost"];
		   
		   $resultcheck = $conn-> query($sqlcheck);
		   
		   if ($resultcheck-> num_rows > 0) {
			   $numResults = mysqli_num_rows($resultcheck);
			   $counter = 0;
			   while ($rowcheck = $resultcheck-> fetch_assoc()) {
				   $namecheck = $rowcheck["name"];
				   
				   if ($name == $namecheck) {
					    echo "<form action='edit.php' method='POST'>";
						
					    $idcheck = $rowcheck["id"];
					   
						echo "<input type='hidden' name='user' value='$user'>";
						echo "<input type='hidden' name='id' value='$idcheck'>";
						echo "<td>".$rowcheck['quantity']."</td><td>";
						echo "<input type='submit' value='Edit'></form>";
				   }
				   else if (++$counter == $numResults) {
					   echo "<form action='join.php' method='POST'>";
		   
					   echo "<input type='hidden' name='user' value='$user'>";
					   echo "<input type='hidden' name='name' value='$name'>";
					   echo "<input type='hidden' name='cost' value='$cost'>";
					   echo "<td><input type='number' name='quantity' value=1 min=1></td><td>";
					   echo "<input type='submit' value='Join'></form>";
				   }
			   }
		   } else {
		   echo "<form action='join.php' method='POST'>";
		   
		   echo "<input type='hidden' name='user' value='$user'>";
		   echo "<input type='hidden' name='name' value='$name'>";
		   echo "<input type='hidden' name='cost' value='$cost'>";
		   echo "<td><input type='number' name='quantity' value=1 min=1></td><td>";
		   echo "<input type='submit' value='Join'></form>";
		   }
	   }
	   echo "</table>";
	} else {
		echo "No events";
	}
	$conn-> close();
	?>
<p>Make payment</p>

<button onclick="myFunction()">Pay now</button>

<p id="demo"></p>

<script>
function myFunction() {
  var txt;
  var r = confirm("Confirm payment?");
  if (r == true) {
	  txt = "Thank you! Payment has been made";
  } else {
	  txt = "";
  }
  document.getElementById("demo").innerHTML = txt;
}
</script>
</table>
</body>
</html>