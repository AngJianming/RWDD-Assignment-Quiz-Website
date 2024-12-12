<?php
// Database configuration
$servername = "localhost"; //host server name
$username = "your_username"; //replace with MySQL username
$password = "your_password"; // replace with MySQL password (I'm pretty sure everyone is the same)
$dbname = "rwdd-assignment-quiz-website"; //database name

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Set PDO error mode to exception for better error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optional: You can set the default fetch mode
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Connection successful
    // echo "Connected successfully";
} catch(PDOException $e) {
    // If there's a connection error, terminate the script and display the error
    die("Connection failed: " . $e->getMessage());
}

// You can now use $conn to interact with your database using PDO
?>
