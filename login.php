<?php
session_start();
include('./config.php');

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Sanitize and validate input
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['login_error'] = "Invalid email format";
        header("Location: login.php");
        exit();
    }

    // Check credentials in the database
    $query = "SELECT * FROM signup WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        // Fetch user data
        $user_data = mysqli_fetch_assoc($result);
        $email = $user_data['email'];

        // Log login history
        $loginTimestamp = date('Y-m-d H:i:s');
        $logLoginQuery = "INSERT INTO login_history (email, login_timestamp) VALUES ('$email', '$loginTimestamp')";
        mysqli_query($con, $logLoginQuery);

        // Store login history ID in session
        $loginHistoryId = mysqli_insert_id($con);
        $_SESSION['email'] = $email;
        $_SESSION['login_history_id'] = $loginHistoryId;

        // Redirect to index page
        header("Location: software.html");
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="fade-in">
    <div class="container">
        <form method="POST" action="login.php">
            <h1>Sign In</h1>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="submit">Sign In</button>
        </form>
    </div>
</body>
</html>
