<?php
// Before session_start()
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // Ensure this is set only if using HTTPS
session_start();


session_start();

// Database configuration
$db_host = "localhost";
$db_user = "your_db_username";
$db_pass = "your_db_password";
$db_name = "rwdd-assignment-quiz-website";

// Create a new MySQLi instance
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($mysqli->connect_error) {
    // Log the error message internally
    error_log("Database connection error: " . $mysqli->connect_error);
    // Display a generic error message to the user
    die("Sorry, we're experiencing technical difficulties. Please try again later.");
}

if (!filter_var($loginEmail, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['errMsg'] = "Invalid email format.";
    header("Location: login_form.php");
    exit();
}


// Initialize variables
$loginEmail = isset($_POST['LoginEmail']) ? trim($_POST['LoginEmail']) : '';
$loginPassword = isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : '';

// Validate inputs
if (empty($loginEmail) || empty($loginPassword)) {
    $_SESSION['errMsg'] = "Please enter both email and password.";
    header("Location: login_form.php"); // Redirect back to login form
    exit();
}

// Prepare the SQL statement to prevent SQL injection
$stmt = $mysqli->prepare("SELECT student_id, student_password FROM student WHERE student_email = ?");
if (!$stmt) {
    error_log("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
    die("Sorry, we're experiencing technical difficulties. Please try again later.");
}

$stmt->bind_param("s", $loginEmail);

// Execute the statement
if (!$stmt->execute()) {
    error_log("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    die("Sorry, we're experiencing technical difficulties. Please try again later.");
}

// Bind the result variables
$stmt->bind_result($student_id, $hashed_password);

// Fetch the result
if ($stmt->fetch()) {
    // Verify the password
    if (password_verify($loginPassword, $hashed_password)) {
        // Password is correct, regenerate session ID to prevent session fixation
        session_regenerate_id(true);
        $_SESSION['userid'] = $student_id;
        header("Location: StudentInformation.php");
        exit();
    } else {
        // Invalid password
        $_SESSION['errMsg'] = "Invalid email or password.";
        header("Location: login_form.php");
        exit();
    }
} else {
    // No user found with that email
    $_SESSION['errMsg'] = "Invalid email or password.";
    header("Location: login_form.php");
    exit();
}

// Close the statement and connection
$stmt->close();
$mysqli->close();
?>








<?php
// Database configuration
$db_host = "localhost";
$db_user = "your_db_username";
$db_pass = "your_db_password";
$db_name = "rwdd-assignment-quiz-website";

// Create a new MySQLi instance
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch all users
$result = $mysqli->query("SELECT student_id, student_password FROM student");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $student_id = $row['student_id'];
        $plain_password = $row['student_password'];
        
        // Hash the password
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
        
        // Update the password in the database
        $update_stmt = $mysqli->prepare("UPDATE student SET student_password = ? WHERE student_id = ?");
        $update_stmt->bind_param("si", $hashed_password, $student_id);
        $update_stmt->execute();
        $update_stmt->close();
    }
    echo "Passwords have been hashed successfully.";
} else {
    echo "Error fetching users: " . $mysqli->error;
}

// Example during registration
$plain_password = $_POST['password'];
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

// Insert into database
$stmt = $mysqli->prepare("INSERT INTO student (student_username, student_password, student_email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hashed_password, $email);
$stmt->execute();


$mysqli->close();
?>










