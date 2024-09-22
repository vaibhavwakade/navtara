<?php
include('./config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Basic validation for empty fields
    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
    } elseif (strlen($password) < 6) {
        echo "Password should be at least 6 characters!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if user already exists
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Email already registered!";
        } else {
            // Insert new user
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "User registered successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        }

        $stmt->close();
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Signup</h2>
        <form action="signup.php" method="post">
            <input type="text" name="username" placeholder="Enter Username" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="submit" value="Signup">
        </form>

        <!-- Login Button -->
        <div class="login-link">
            <p>Already have an account?</p>
            <a href="login.php"><button type="button">Login</button></a>
        </div>
    </div>
</body>
</html>
