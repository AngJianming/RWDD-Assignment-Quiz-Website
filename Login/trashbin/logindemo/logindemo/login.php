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
    $remember_me = isset($_POST['remember_me']);

    // Query to get the password for the given username
    $sql = "SELECT password FROM users WHERE username = '$input_username'";
    $result = mysqli_query($conn, $sql);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];

        // Verify password
        if ($input_password == $stored_password) {
            // Store user information in session
            $_SESSION['username'] = $input_username;

            // Set or clear cookies based on the checkbox
            if ($remember_me) {
                setcookie('username', $input_username, time() + (86400 * 30), "/"); // 30 days
                setcookie('password', $input_password, time() + (86400 * 30), "/"); // 30 days
            } else {
                setcookie('username', '', time() - 3600, "/"); // Expire the cookie
                setcookie('password', '', time() - 3600, "/"); // Expire the cookie
            }

            header("location:protected.php");
        } else {
            echo "<script>alert('Invalid username or password!');</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password!');</script>";
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
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="post">
    <h1>User Login</h1><br>
    Username<br>
    <input type="text" name="username" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>" required><br><br>

    Password<br>
    <input type="password" name="password" value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>" required><br><br>

    <input type="checkbox" name="remember_me" <?php echo isset($_COOKIE['username']) ? 'checked' : ''; ?>> Remember me<br><br>

    <input type="submit" value="Login">
    <input type="reset" value="Reset">

    <p>No account yet? Please <a href="register.php">register</a></p>
</form>
</body>
</html>