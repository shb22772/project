<?php
$servername = "localhost";
$username = "root";  // Change this as per your MySQL username
$password = "";      // Change this as per your MySQL password
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$user = $_POST['username'];
$pass = $_POST['password'];
$confirm_pass = $_POST['confirm_password'];
$email = $_POST['email'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

// Check if passwords match
if ($pass !== $confirm_pass) {
    die("Passwords do not match.");
}

// Hash the password for security
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

// Insert data into database
$sql = "INSERT INTO users (username, password, email, first_name, last_name)
VALUES ('$user', '$hashed_password', '$email', '$first_name', '$last_name')";

if ($conn->query($sql) === TRUE) {
    echo "Signup successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>