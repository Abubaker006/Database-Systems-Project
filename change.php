<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'userlogin';

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_errno) {
  die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$userEmail = $_POST["userEmail"];
$password = $_POST["password"];
$confirmPassword = $_POST["confirmPassword"];

// Check if the new password and confirm password match
if ($password !== $confirmPassword) {
  echo "Passwords do not match.";
  exit;
}

// Prepare and execute the query to select the user with the given email
$sql = "SELECT * FROM userdetails WHERE User_Email = ?";
$stmt = $mysqli->prepare($sql);
if ($stmt) {
  $stmt->bind_param("s", $userEmail);
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result) {
    if ($result->num_rows > 0) {
      // User found, update the password
      $sql = "UPDATE userdetails SET UserPassword = ? WHERE User_Email = ?";
      $stmt = $mysqli->prepare($sql);
      if ($stmt) {
        $stmt->bind_param("ss", $password, $userEmail);
        $stmt->execute();
        $stmt->close();
        header("Location:index.html");//if pass updates then it will redirect to the page else-not
      } else {
        echo "Failed to update password.";
      }
    } else {
      echo "No user found with the provided email.";
    }
  } else {
    echo "Error executing the query: " . $mysqli->error;
  }
} else {
  echo "Failed to prepare the query.";
}

$mysqli->close();
?>
