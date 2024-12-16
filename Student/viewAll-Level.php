<?php
// Student/viewAll-Level.php

// Start Output Buffering to prevent "headers already sent" errors
ob_start();
session_start();

// Include necessary files
include '../Constants/Combine-student.php'; // Ensure this file does NOT produce any output
require '../Database/connection.php';

// Initialize variables for messages
$error = '';
$success = '';

// Determine the action based on URL parameter
$action = isset($_GET['action']) ? $_GET['action'] : 'list_levels';

// Handle different actions
switch ($action) {
    case 'start_quiz':
        // Start the quiz by redirecting to StartQuiz.php
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $ranked_quiz_id = (int)$_GET['id'];
            // Redirect to StartQuiz.php with the quiz ID
            header("Location: StartQuiz.php?id=" . $ranked_quiz_id);
            exit();
        } else {
            header("Location: viewAll-Level.php?error=invalid_quiz_id");
            exit();
        }
        break;

    case 'list_levels':
    default:
        // List all quiz levels (publicly accessible)
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

        // Display list of quiz levels
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Available Quiz Levels</title>
            <link rel="stylesheet" href="viewAll-Level.css">
            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                th, td {
                    padding: 12px;
                    border: 1px solid #ddd;
                    text-align: center;
                }
                .btn {
                    padding: 8px 16px;
                    background-color: #4CAF50;
                    color: white;
                    text-decoration: none;
                    border-radius: 4px;
                }
                .btn:hover {
                    background-color: #45a049;
                }
                .alert {
                    padding: 10px;
                    margin-bottom: 15px;
                    border: 1px solid transparent;
                    border-radius: 4px;
                }
                .error {
                    color: #a94442;
                    background-color: #f2dede;
                    border-color: #ebccd1;
                }
                .success {
                    color: #3c763d;
                    background-color: #dff0d8;
                    border-color: #d6e9c6;
                }
            </style>
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

                <?php if (!empty($levels)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Quiz Level</th>
                                <th>Quiz Name</th>
                                <th>Duration (mins)</th>
                                <th>Total Score</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($levels as $level): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($level['ranked_quiz_level']); ?></td>
                                    <td><?php echo htmlspecialchars($level['ranked_quiz_name']); ?></td>
                                    <td><?php echo htmlspecialchars($level['ranked_quiz_duration']); ?></td>
                                    <td><?php echo htmlspecialchars($level['ranked_score']); ?></td>
                                    <td>
                                        <a href="viewAll-Level.php?action=start_quiz&id=<?php echo htmlspecialchars($level['ranked_quiz_id']); ?>" class="btn">Start Quiz</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No quiz levels available at the moment. Please check back later.</p>
                <?php endif; ?>
            </div>
        </body>
        </html>
        <?php
        break;
}

// Flush the output buffer
ob_end_flush();

// Close the database connection
$conn->close();
?>
