<?php
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "vertexuniversity";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get form data
$user_name = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$phone = $_POST['phonenumber'];

// Check if username already exists
$check_query = "SELECT * FROM SignUp WHERE User_Name = '$user_name'";
$result = $con->query($check_query);

if ($result->num_rows > 0) {
    // Username exists. So show error
    echo "<script>
            alert('Username already exists. Please choose a different one.');
            window.location.href='signup.html';
          </script>";
} else {
    // Insert a new user
    $insert_query = "INSERT INTO SignUp (User_Name, Password, Email, Phone) 
                     VALUES ('$user_name', '$password', '$email', '$phone')";

    if ($con->query($insert_query) === TRUE) {
        echo "<script>
                alert('Your Sign Up was successful!');
                window.location.href='HomePage.html';
              </script>";
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

$con->close();
?>
