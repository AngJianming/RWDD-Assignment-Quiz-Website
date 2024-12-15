<?php
// hash_passwords.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rwdd-assignment-quiz-website";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to hash a password
function hashPassword($plainPassword) {
    return password_hash($plainPassword, PASSWORD_DEFAULT);
}

// Update passwords in the admin table
$tables = ['admin', 'educator', 'student'];
foreach ($tables as $table) {
    // Fetch all records
    $sql = "SELECT * FROM `$table`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id_field = $table . '_id';
            $password_field = $table . '_password';
            $user_id = $row[$id_field];
            $plain_password = $row[$password_field];

            // Hash the password
            $hashed_password = hashPassword($plain_password);

            // Update the password in the database
            $update_sql = "UPDATE `$table` SET `$password_field` = ? WHERE `$id_field` = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("si", $hashed_password, $user_id);
            $stmt->execute();
        }
        echo "Passwords in `$table` table have been hashed.<br>";
    }
}

$conn->close();
?>
