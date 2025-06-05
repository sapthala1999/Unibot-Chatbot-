<?php
// DB connection
$conn = new mysqli("localhost", "root", "", "vertexuniversity");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect data from form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Query database
$sql = "SELECT * FROM SignUp WHERE User_Name='$username' AND Password='$password'";
$result = $conn->query($sql);

// Check if user exists
if ($result->num_rows > 0) {
    header("Location: Unibot.html"); // success and go to chatbot
    exit();
} else {
    echo "<script>alert('Invalid username or password'); window.location.href='login.html';</script>";
}

$conn->close();
?>
