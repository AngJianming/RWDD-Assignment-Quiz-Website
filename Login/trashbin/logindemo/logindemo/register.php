<?php
// Start the session
session_start();

// Database connection details
$servername = "localhost";
$dbname = "myaddressbook";
$dbusername = "root";
$dbpassword = "root";

// CREATE TABLE users (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(50) NOT NULL,
//     password VARCHAR(255) NOT NULL
// );

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE username = '$input_username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username already taken!');</script>";
    } else {
        // Insert user with hashed password
        $sql = "INSERT INTO users (username, password) VALUES ('$input_username', '$input_password')";
        mysqli_query($conn, $sql);

        // Redirect to a success page or other appropriate action
       echo "<script>alert('Successfully registered!');window.location.href='login.php';</script>";
        exit();
    }

    mysqli_free_result($result);
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form method="post">
        <h1>User Registration</h1><br>
        Username<br>
        <input type="text" name="username" required><br><br>

        Password<br>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Register">
        <input type="reset" value="Reset">
    </form>
</body>

</html>