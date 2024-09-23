<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "system";
$dbname = "internship";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $mobileNumber = mysqli_real_escape_string($conn, $_POST['mobileNumber']);
    
    // Hash the password before saving it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM signup WHERE email='$email'";
    $result = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "Email already exists.";
    } else {
        // Insert data into signup table with hashed password
        $query = "INSERT INTO signup (full_name, email, password, mobile_number) 
                  VALUES ('$fullName', '$email', '$hashedPassword', '$mobileNumber')";

        if (mysqli_query($conn, $query)) {
            echo "Sign up successful!";
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="slide-in">
    <div class="container">
        <form method="POST" action="signup.php">
            <h1>Create Account</h1>
            <input type="text" name="fullName" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="tel" name="mobileNumber" placeholder="Mobile Number" required>
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
