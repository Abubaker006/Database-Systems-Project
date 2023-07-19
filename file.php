<?php

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validate user input
if (empty($name) || empty($email) || empty($password)) {
    die("Please fill in all the required fields.");
}

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'userlogin'); //connect you to the database
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Check if the email already exists
$validationQuery = $conn->prepare("SELECT User_Email FROM userdetails WHERE User_Email = ?");
if (!$validationQuery) {
    die('Prepare Failed: ' . $conn->error);
}

$validationQuery->bind_param("s", $email); //to bind parameter to the specified variable name in a sql statment in order to access the database
if (!$validationQuery->execute()) {
    die('Execute Failed: ' . $validationQuery->error);
}

$validationQuery->store_result();
if ($validationQuery->num_rows > 0) {
    die('This Email already exists. Please choose a different one.');
}
//is this query has executed then insertion wouldnt happen
$validationQuery->close();

// Prepare and execute the SQL query to insert the new user
$stmt = $conn->prepare("INSERT INTO userdetails (UserName, User_Email, UserPassword) VALUES (?, ?, ?)"); //binds the parameter to sql query and tells the database what the parameters are
if (!$stmt) {
    die('Prepare Failed: ' . $conn->error);
}

$stmt->bind_param("sss", $name, $email, $password);
if (!$stmt->execute()) {
    die('Execute Failed: ' . $stmt->error);
}

$stmt->close();
$conn->close();

// Set the success message
echo "Registered Successfully! Reload the page now to go back.";

?>
