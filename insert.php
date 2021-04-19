    <?php
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $participants = $_POST['participants'];
	$cost = $_POST['cost'];
    if (!empty($name) || !empty($description) || !empty($date) || !empty($participants) || !empty($cost)) {
     $host = "localhost";
        $dbUsername = "root";
        $dbdescription = "";
        $dbname = "event";
        //create connection
        $conn = new mysqli($host, $dbUsername, $dbdescription, $dbname);
        if (mysqli_connect_error()) {
         die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
        } else {
		 $SELECT = "SELECT name From createevent Where name = ? Limit 1";
         $INSERT = "INSERT Into createevent (name, description, date, participants, cost) values(?, ?, ?, ?, ?)";
         //Prepare statement
         $stmt = $conn->prepare($SELECT);
         $stmt->bind_param("s", $name);
         $stmt->execute();
         $stmt->bind_result($name);
         $stmt->store_result();
         $rnum = $stmt->num_rows;
         if ($rnum==0) {
          $stmt->close();
          $stmt = $conn->prepare($INSERT);
          $stmt->bind_param("sssii", $name, $description, $date, $participants, $cost);
          $stmt->execute();
          echo "New event created ";
		  echo "<a href=staff.php>Back</a>";
         } else {
          echo "Event name taken";
         }
         $stmt->close();
         $conn->close();
        }
    } else {
     echo "All field are required";
     die();
    }
    ?>