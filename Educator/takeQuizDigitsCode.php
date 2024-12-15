<?php
/**
 * Generates a unique 4-digit quiz code.
 *
 * @param mysqli $conn The MySQLi connection object.
 * @return int A unique 4-digit quiz code.
 */
function generateUniqueQuizCode($conn) {
    do {
        $code = rand(1000, 9999); // Generates a random 4-digit code
        // Check if the code already exists
        $stmt = $conn->prepare("SELECT quiz_id FROM custom_quiz WHERE quiz_code = ?");
        $stmt->bind_param("i", $code);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows > 0;
        $stmt->close();
    } while ($exists);
    
    return $code;
}

// **Usage Example:**
$unique_code = generateUniqueQuizCode($conn);
// Now, use $unique_code when creating a new quiz
?>
