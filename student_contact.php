<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentName = mysqli_real_escape_string($conn, $_POST['studentName']);
    $collegeName = mysqli_real_escape_string($conn, $_POST['collegeName']);
    $mobileNumber = mysqli_real_escape_string($conn, $_POST['mobileNumber']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);

    // Insert data into student_contact table
    $query = "INSERT INTO student_contact (student_name, college_name, mobile_number, year) 
              VALUES ('$studentName', '$collegeName', '$mobileNumber', '$year')";

    if (mysqli_query($conn, $query)) {
        echo "Data submitted successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
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
    <title>Student Contact Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="fade-in">
    <div class="container">
        <form method="POST" action="student_contact.php">
            <h1>Student Information</h1>
            <input type="text" name="studentName" placeholder="Student Name" required>
            <input type="text" name="collegeName" placeholder="College Name" required>
            <input type="tel" name="mobileNumber" placeholder="Mobile Number" required>
            <input type="text" name="year" placeholder="Year of Study" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
