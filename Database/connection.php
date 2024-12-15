<?php
/**
 * connection.php
 *
 * This file establishes a connection to the MySQL database `rwdd-assignment-quiz-website`
 * using PHP's mysqli extension. It includes error handling and sets the appropriate
 * character encoding for the connection.
 *
 * **Usage:**
 * Include this file in your PHP scripts using `require` or `include` to access the
 * `$conn` variable for database operations.
 *
 * **Example:**
 * ```php
 * <?php
 * require 'connection.php';
 *
 * // Your database operations here
 *
 * $conn->close(); // Close the connection when done
 * ?>
 * ```
 */

// **1. Database Configuration**
$servername = "127.0.0.1";                // Hostname (typically "localhost" or "127.0.0.1")
$username = "root";         // Replace with your MySQL username
$password = "";         // Replace with your MySQL password
$dbname = "rwdd-assignment-quiz-website";  // Database name

// **2. Create Connection**
$conn = new mysqli($servername, $username, $password, $dbname);

// **3. Check Connection**
if ($conn->connect_error) {
    // Log the error to a file instead of displaying it to the user
    error_log("Connection failed: " . $conn->connect_error, 3, __DIR__ . "/logs/db_errors.log");
    // Display a generic error message to the user
    die("Connection to the database failed. Please try again later.");
}

// **4. Set Character Set to UTF-8**
if (!$conn->set_charset("utf8mb4")) {
    error_log("Error loading character set utf8mb4: " . $conn->error, 3, __DIR__ . "/logs/db_errors.log");
    die("Error loading character set. Please try again later.");
}

/**
 * Now you can use the `$conn` object to perform database operations.
 * Remember to close the connection using `$conn->close();` when done.
 */

// Example Usage:
$result = $conn->query("SELECT * FROM admin");
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["admin_id"]. " - Username: " . $row["admin_username"]. "<br>";
    }
} else {
    echo "0 results";
}

// **5. Close Connection (Optional)**
// It's a good practice to close the connection when it's no longer needed.
$conn->close();
?>
