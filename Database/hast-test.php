<?php
// hash_passwords.php

$servername = "localhost";
$dbname = "rwdd-assignment-quiz-website";
$username = "root";
$password = "";

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

// Tables to update
$tables = ['admin', 'educator', 'student'];

foreach ($tables as $table) {
    // Determine the password field based on table
    switch ($table) {
        case 'admin':
            $password_field = 'admin_password';
            $id_field = 'admin_id';
            break;
        case 'educator':
            $password_field = 'educator_password';
            $id_field = 'educator_id';
            break;
        case 'student':
            $password_field = 'student_password';
            $id_field = 'student_id';
            break;
    }

    // Fetch all records
    $sql = "SELECT `$id_field`, `$password_field` FROM `$table`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_id = $row[$id_field];
            $plain_password = $row[$password_field];

            // Check if the password is already hashed
            if (!password_verify($plain_password, $plain_password)) {
                // Hash the password
                $hashed_password = hashPassword($plain_password);

                // Update the password in the database
                $update_sql = "UPDATE `$table` SET `$password_field` = ? WHERE `$id_field` = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("si", $hashed_password, $user_id);
                $stmt->execute();
            }
        }
        echo "Passwords in `$table` table have been hashed.<br>";
    }
}

$conn->close();
?>
