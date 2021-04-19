    <?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];
    if (!empty($username) || !empty($password) || !empty($usertype)) {
     $host = "localhost";
        $dbUsername = "root";
        $dbdescription = "";
        $dbname = "login";
        //create connection
        $conn = new mysqli($host, $dbUsername, $dbdescription, $dbname);
        if (mysqli_connect_error()) {
         die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
        } else {
		 $SELECT = "SELECT username From users Where username = ? Limit 1";
         $INSERT = "INSERT Into users (username, password, usertype) values(?, ?, ?)";
         //Prepare statement
         $stmt = $conn->prepare($SELECT);
         $stmt->bind_param("s", $username);
         $stmt->execute();
         $stmt->bind_result($username);
         $stmt->store_result();
         $rnum = $stmt->num_rows;
         if ($rnum==0) {
          $stmt->close();
          $stmt = $conn->prepare($INSERT);
          $stmt->bind_param("sss", $username, $password, $usertype);
          $stmt->execute();
          echo "New user created ";
		  echo "<a href=admin.php>Back</a>";
         } else {
          echo "Username taken";
         }
         $stmt->close();
         $conn->close();
        }
    } else {
     echo "All field are required";
     die();
    }
    ?>