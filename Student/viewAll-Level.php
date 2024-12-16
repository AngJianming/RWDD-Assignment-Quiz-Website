<?php
// Student/viewAll-Level.php

session_start();

// Include DB connection
require '../Database/connection.php';

// Check if student is logged in
// if (!isset($_SESSION['student_username'])) {
//     header("Location: student_login.php"); // Redirect to student login page
//     exit();
// }

// Initialize variables for messages
$error = '';
$success = '';

// Fetch all quiz levels ordered by ranked_quiz_id
$stmt = $conn->prepare("SELECT * FROM ranked_quiz_levels ORDER BY ranked_quiz_id ASC");
if ($stmt) {
    $stmt->execute();
    $result_levels = $stmt->get_result();
    $levels = [];
    while ($row = $result_levels->fetch_assoc()) {
        $levels[] = $row;
    }
    $stmt->close();
} else {
    $error = "Database error: " . $conn->error;
}

// Handle messages from URL
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
}
if (isset($_GET['success'])) {
    $success = htmlspecialchars($_GET['success']);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Quiz Levels</title>
    <link rel="stylesheet" href="viewAll-Level.css">
</head>
<body>
    <div class="container">
        <h1>Available Quiz Levels</h1>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <div class="levels" id="levels-container">
            <?php foreach ($levels as $level): ?>
                <div class="level-card">
                    <h2><?php echo htmlspecialchars($level['ranked_quiz_level']); ?></h2>
                    <p><?php echo htmlspecialchars($level['ranked_quiz_name']); ?></p>
                    <p>Duration: <?php echo htmlspecialchars($level['ranked_quiz_duration']); ?> mins</p>
                    <p>Total Score: <?php echo htmlspecialchars($level['ranked_score']); ?></p>
                    <a href="StartQuiz.php?id=<?php echo $level['ranked_quiz_id']; ?>" class="btn">Play Quiz</a>
                </div>
            <?php endforeach; ?>
            <?php if (empty($levels)): ?>
                <p>No quizzes are currently available. Please check back later.</p>
            <?php endif; ?>
        </div>

        <div class="actions">
            <a href="logout.php" class="btn logout-btn">Logout</a>
        </div>
    </div>
</body>
</html>
