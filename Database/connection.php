<?php

// **1. Database Configuration**
$servername = "localhost";                // Hostname (typically "localhost" or "127.0.0.1")
$username = "root";         // Replace with your MySQL username
$password = "";         // Replace with your MySQL password
$dbname = "rwdd-assignment-quiz-website";  // Database name

// **2. Create Connection**
$conn = new mysqli($servername, $username, $password, $dbname);

// **3. Check Connection**
if ($conn->connect_error) {
    die("Database connection error ".$conn->connect_error);
}

echo "Connected successfully";

?>