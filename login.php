<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'userlogin';

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_errno) {
  die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$name=$_POST["name"];
$email=$_POST["email"];
$password=$_POST["password"];

$sql="SELECT * From userdetails  WHERE UserName = ? AND User_Email = ? AND UserPassword	
= ?";
$stmt=$mysqli->prepare($sql);
if ($stmt) {
  // Bind the parameters with the values
  $stmt->bind_param("sss", $name, $email, $password);

  // Execute the statement
  $stmt->execute();

  // Get the result set
  $result = $stmt->get_result();
  // Check if the query executed successfully
  if ($result) {
    if ($result->num_rows > 0) {
      // Query executed successfully, fetch and display the data
      while($row = $result->fetch_assoc())
      {
         if($row["UserName"]==$name && $row["User_Email"]==$email && $row["UserPassword"]==$password)
         {
          header("Location:admin.html");
          break;
         }
      }
    }
    else{
      echo "No Records Were found";
    }
  } else {
      // Query execution failed
        echo "Error executing the query: " . $mysqli->error;
  }

  // Close the statement
  $stmt->close();
}
else{
  echo "Unregistered Login";
}
?>