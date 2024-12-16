<?php
// Admin/addranked.php

session_start();

// Include admin environment file if needed
include '../Constants/Combine-admin.php';

// Include DB connection
require '../Database/connection.php';

// Check if admin is logged in
// if (!isset($_SESSION['admin_username'])) {
//     header("Location: admin_login.php"); // Redirect to admin login page
//     exit();
// }

// Initialize variables for messages
$error = '';
$success = '';

// Determine the action based on URL parameter
$action = isset($_GET['action']) ? $_GET['action'] : 'list_levels';

// Handle different actions
switch ($action) {
    case 'add_level':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle adding a new quiz level
            $ranked_quiz_level = isset($_POST['ranked_quiz_level']) ? trim($_POST['ranked_quiz_level']) : '';
            $ranked_quiz_name = isset($_POST['ranked_quiz_name']) ? trim($_POST['ranked_quiz_name']) : '';
            $ranked_quiz_duration = isset($_POST['ranked_quiz_duration']) ? (int)$_POST['ranked_quiz_duration'] : 0;
            $ranked_score = isset($_POST['ranked_score']) ? (int)$_POST['ranked_score'] : 0;

            // Validation
            if (empty($ranked_quiz_level) || empty($ranked_quiz_name) || $ranked_quiz_duration <= 0 || $ranked_score <= 0) {
                $error = "All fields are required and must be valid.";
            } else {
                // Insert into ranked_quiz_levels
                $stmt = $conn->prepare("INSERT INTO ranked_quiz_levels (ranked_quiz_level, ranked_quiz_name, ranked_quiz_duration, ranked_score) VALUES (?, ?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param("ssii", $ranked_quiz_level, $ranked_quiz_name, $ranked_quiz_duration, $ranked_score);
                    if ($stmt->execute()) {
                        $success = "Quiz level added successfully.";
                    } else {
                        $error = "Error adding quiz level: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $error = "Database error: " . $conn->error;
                }
            }
        }

        // Display add level form
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Add Quiz Level</title>
            <link rel="stylesheet" href="addranked.css">
        </head>
        <body>
            <div class="container">
                <h1>Add New Quiz Level</h1>

                <?php if (!empty($error)): ?>
                    <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <div class="alert success"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>

                <form action="addranked.php?action=add_level" method="POST">
                    <div class="form-group">
                        <label for="ranked_quiz_level">Quiz Level:</label>
                        <input type="text" id="ranked_quiz_level" name="ranked_quiz_level" placeholder="e.g., Level 1" required>
                    </div>

                    <div class="form-group">
                        <label for="ranked_quiz_name">Quiz Name:</label>
                        <input type="text" id="ranked_quiz_name" name="ranked_quiz_name" placeholder="e.g., Superb Basic Python" required>
                    </div>

                    <div class="form-group">
                        <label for="ranked_quiz_duration">Duration (minutes):</label>
                        <input type="number" id="ranked_quiz_duration" name="ranked_quiz_duration" min="1" required>
                    </div>

                    <div class="form-group">
                        <label for="ranked_score">Total Score:</label>
                        <input type="number" id="ranked_score" name="ranked_score" min="1" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn">Add Quiz Level</button>
                        <a href="addranked.php" class="btn">Back to Quiz Levels</a>
                    </div>
                </form>
            </div>
        </body>
        </html>
        <?php
        break;

    case 'edit_level':
        $ranked_quiz_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        // Fetch existing quiz level details
        $stmt = $conn->prepare("SELECT * FROM ranked_quiz_levels WHERE ranked_quiz_id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $ranked_quiz_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows !== 1) {
                header("Location: addranked.php?msg=level_not_found");
                exit();
            }
            $quiz_level = $result->fetch_assoc();
            $stmt->close();
        } else {
            $error = "Database error: " . $conn->error;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle updating the quiz level
            $ranked_quiz_level = isset($_POST['ranked_quiz_level']) ? trim($_POST['ranked_quiz_level']) : '';
            $ranked_quiz_name = isset($_POST['ranked_quiz_name']) ? trim($_POST['ranked_quiz_name']) : '';
            $ranked_quiz_duration = isset($_POST['ranked_quiz_duration']) ? (int)$_POST['ranked_quiz_duration'] : 0;
            $ranked_score = isset($_POST['ranked_score']) ? (int)$_POST['ranked_score'] : 0;

            // Validation
            if (empty($ranked_quiz_level) || empty($ranked_quiz_name) || $ranked_quiz_duration <= 0 || $ranked_score <= 0) {
                $error = "All fields are required and must be valid.";
            } else {
                // Update the quiz level
                $stmt = $conn->prepare("UPDATE ranked_quiz_levels SET ranked_quiz_level = ?, ranked_quiz_name = ?, ranked_quiz_duration = ?, ranked_score = ? WHERE ranked_quiz_id = ?");
                if ($stmt) {
                    $stmt->bind_param("ssiii", $ranked_quiz_level, $ranked_quiz_name, $ranked_quiz_duration, $ranked_score, $ranked_quiz_id);
                    if ($stmt->execute()) {
                        $success = "Quiz level updated successfully.";
                        // Refresh the quiz_level variable
                        $quiz_level['ranked_quiz_level'] = $ranked_quiz_level;
                        $quiz_level['ranked_quiz_name'] = $ranked_quiz_name;
                        $quiz_level['ranked_quiz_duration'] = $ranked_quiz_duration;
                        $quiz_level['ranked_score'] = $ranked_score;
                    } else {
                        $error = "Error updating quiz level: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $error = "Database error: " . $conn->error;
                }
            }
        }

        // Display edit level form
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Edit Quiz Level</title>
            <link rel="stylesheet" href="addranked.css">
        </head>
        <body>
            <div class="container">
                <h1>Edit Quiz Level</h1>

                <?php if (!empty($error)): ?>
                    <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <div class="alert success"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>

                <form action="addranked.php?action=edit_level&id=<?php echo $ranked_quiz_id; ?>" method="POST">
                    <div class="form-group">
                        <label for="ranked_quiz_level">Quiz Level:</label>
                        <input type="text" id="ranked_quiz_level" name="ranked_quiz_level" placeholder="e.g., Level 1" required value="<?php echo htmlspecialchars($quiz_level['ranked_quiz_level']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="ranked_quiz_name">Quiz Name:</label>
                        <input type="text" id="ranked_quiz_name" name="ranked_quiz_name" placeholder="e.g., Superb Basic Python" required value="<?php echo htmlspecialchars($quiz_level['ranked_quiz_name']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="ranked_quiz_duration">Duration (minutes):</label>
                        <input type="number" id="ranked_quiz_duration" name="ranked_quiz_duration" min="1" required value="<?php echo htmlspecialchars($quiz_level['ranked_quiz_duration']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="ranked_score">Total Score:</label>
                        <input type="number" id="ranked_score" name="ranked_score" min="1" required value="<?php echo htmlspecialchars($quiz_level['ranked_score']); ?>">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn">Update Quiz Level</button>
                        <a href="addranked.php" class="btn">Back to Quiz Levels</a>
                    </div>
                </form>
            </div>
        </body>
        </html>
        <?php
        break;

    case 'publish_level':
        $ranked_quiz_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        // Check if the quiz level exists
        $stmt = $conn->prepare("SELECT is_published FROM ranked_quiz_levels WHERE ranked_quiz_id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $ranked_quiz_id);
            $stmt->execute();
            $stmt->bind_result($is_published);
            if ($stmt->fetch()) {
                if ($is_published) {
                    $error = "Quiz level is already published.";
                } else {
                    // Check if there are questions associated
                    $stmt->close();
                    $stmt = $conn->prepare("SELECT COUNT(*) FROM questions WHERE ranked_quiz_id = ?");
                    if ($stmt) {
                        $stmt->bind_param("i", $ranked_quiz_id);
                        $stmt->execute();
                        $stmt->bind_result($question_count);
                        $stmt->fetch();
                        $stmt->close();

                        if ($question_count < 1) {
                            $error = "Cannot publish quiz level without any questions.";
                        } else {
                            // Publish the quiz level
                            $stmt = $conn->prepare("UPDATE ranked_quiz_levels SET is_published = 1 WHERE ranked_quiz_id = ?");
                            if ($stmt) {
                                $stmt->bind_param("i", $ranked_quiz_id);
                                if ($stmt->execute()) {
                                    $success = "Quiz level published successfully.";
                                } else {
                                    $error = "Error publishing quiz level: " . $stmt->error;
                                }
                                $stmt->close();
                            } else {
                                $error = "Database error: " . $conn->error;
                            }
                        }
                    } else {
                        $error = "Database error: " . $conn->error;
                    }
                }
            } else {
                $error = "Quiz level not found.";
            }
            $stmt->close();
        } else {
            $error = "Database error: " . $conn->error;
        }

        // Redirect back to list_levels with message
        if (!empty($error)) {
            header("Location: addranked.php?action=list_levels&error=" . urlencode($error));
        } elseif (!empty($success)) {
            header("Location: addranked.php?action=list_levels&success=" . urlencode($success));
        } else {
            header("Location: addranked.php?action=list_levels");
        }
        exit();
        break;

    case 'delete_level':
        $ranked_quiz_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        // Delete the quiz level (questions will be deleted via ON DELETE CASCADE)
        $stmt = $conn->prepare("DELETE FROM ranked_quiz_levels WHERE ranked_quiz_id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $ranked_quiz_id);
            if ($stmt->execute()) {
                $success = "Quiz level deleted successfully.";
            } else {
                $error = "Error deleting quiz level: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error = "Database error: " . $conn->error;
        }

        // Redirect back to list_levels with message
        if (!empty($error)) {
            header("Location: addranked.php?action=list_levels&error=" . urlencode($error));
        } elseif (!empty($success)) {
            header("Location: addranked.php?action=list_levels&success=" . urlencode($success));
        } else {
            header("Location: addranked.php?action=list_levels");
        }
        exit();
        break;

    case 'manage_questions':
        $ranked_quiz_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        // Fetch quiz level details
        $stmt = $conn->prepare("SELECT * FROM ranked_quiz_levels WHERE ranked_quiz_id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $ranked_quiz_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows !== 1) {
                header("Location: addranked.php?action=list_levels&msg=level_not_found");
                exit();
            }
            $quiz_level = $result->fetch_assoc();
            $stmt->close();
        } else {
            $error = "Database error: " . $conn->error;
        }

        // Handle adding a new question
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_question'])) {
            $question_text = isset($_POST['question_text']) ? trim($_POST['question_text']) : '';
            $option_A = isset($_POST['option_A']) ? trim($_POST['option_A']) : '';
            $option_B = isset($_POST['option_B']) ? trim($_POST['option_B']) : '';
            $option_C = isset($_POST['option_C']) ? trim($_POST['option_C']) : '';
            $option_D = isset($_POST['option_D']) ? trim($_POST['option_D']) : '';
            $correct_option = isset($_POST['correct_option']) ? strtoupper(trim($_POST['correct_option'])) : '';

            // Validation
            if (empty($question_text) || empty($option_A) || empty($option_B) || empty($option_C) || empty($option_D) || empty($correct_option)) {
                $error = "All fields are required.";
            } elseif (!in_array($correct_option, ['A', 'B', 'C', 'D'])) {
                $error = "Correct option must be one of A, B, C, or D.";
            } else {
                // Determine the next question number
                $stmt = $conn->prepare("SELECT MAX(question_no) FROM questions WHERE ranked_quiz_id = ?");
                if ($stmt) {
                    $stmt->bind_param("i", $ranked_quiz_id);
                    $stmt->execute();
                    $stmt->bind_result($max_question_no);
                    $stmt->fetch();
                    $stmt->close();

                    $next_question_no = ($max_question_no) ? $max_question_no + 1 : 1;

                    // Generate a unique question_id (e.g., "L1Q1")
                    $level_prefix = "L" . $ranked_quiz_id;
                    $question_id = $level_prefix . "Q" . $next_question_no;

                    // Insert the new question
                    $stmt = $conn->prepare("INSERT INTO questions (question_id, question_no, question_text, option_A, option_B, option_C, option_D, correct_option, ranked_quiz_id, quiz_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NULL)");
                    if ($stmt) {
                        $stmt->bind_param("sissssssi", $question_id, $next_question_no, $question_text, $option_A, $option_B, $option_C, $option_D, $correct_option, $ranked_quiz_id);
                        if ($stmt->execute()) {
                            $success = "Question added successfully.";
                        } else {
                            $error = "Error adding question: " . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        $error = "Database error: " . $conn->error;
                    }
                } else {
                    $error = "Database error: " . $conn->error;
                }
            }
        }

        // Handle deleting a question
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_question_id'])) {
            $question_id = $_GET['delete_question_id'];

            // Delete the question
            $stmt = $conn->prepare("DELETE FROM questions WHERE question_id = ?");
            if ($stmt) {
                $stmt->bind_param("s", $question_id);
                if ($stmt->execute()) {
                    $success = "Question deleted successfully.";
                } else {
                    $error = "Error deleting question: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $error = "Database error: " . $conn->error;
            }
        }

        // Fetch all questions for this quiz level
        $stmt = $conn->prepare("SELECT * FROM questions WHERE ranked_quiz_id = ? ORDER BY question_no ASC");
        if ($stmt) {
            $stmt->bind_param("i", $ranked_quiz_id);
            $stmt->execute();
            $result_questions = $stmt->get_result();
            $questions = [];
            while ($row = $result_questions->fetch_assoc()) {
                $questions[] = $row;
            }
            $stmt->close();
        } else {
            $error = "Database error: " . $conn->error;
        }

        // Display manage questions interface
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Manage Questions - <?php echo htmlspecialchars($quiz_level['ranked_quiz_level'] . " - " . $quiz_level['ranked_quiz_name']); ?></title>
            <link rel="stylesheet" href="addranked.css">
        </head>
        <body>
            <div class="container">
                <h1>Manage Questions for <?php echo htmlspecialchars($quiz_level['ranked_quiz_level'] . " - " . $quiz_level['ranked_quiz_name']); ?></h1>

                <?php if (!empty($error)): ?>
                    <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <div class="alert success"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>

                <h2>Add New Question</h2>
                <form action="addranked.php?action=manage_questions&id=<?php echo $ranked_quiz_id; ?>" method="POST">
                    <input type="hidden" name="add_question" value="1">
                    <div class="form-group">
                        <label for="question_text">Question Text:</label>
                        <textarea id="question_text" name="question_text" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="option_A">Option A:</label>
                        <input type="text" id="option_A" name="option_A" required>
                    </div>

                    <div class="form-group">
                        <label for="option_B">Option B:</label>
                        <input type="text" id="option_B" name="option_B" required>
                    </div>

                    <div class="form-group">
                        <label for="option_C">Option C:</label>
                        <input type="text" id="option_C" name="option_C" required>
                    </div>

                    <div class="form-group">
                        <label for="option_D">Option D:</label>
                        <input type="text" id="option_D" name="option_D" required>
                    </div>

                    <div class="form-group">
                        <label for="correct_option">Correct Option:</label>
                        <select id="correct_option" name="correct_option" required>
                            <option value="">--Select Correct Option--</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn">Add Question</button>
                        <a href="addranked.php?action=list_levels" class="btn">Back to Quiz Levels</a>
                    </div>
                </form>

                <h2>Existing Questions</h2>
                <?php if (!empty($questions)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Question No.</th>
                                <th>Question Text</th>
                                <th>Option A</th>
                                <th>Option B</th>
                                <th>Option C</th>
                                <th>Option D</th>
                                <th>Correct Option</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($questions as $question): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($question['question_no']); ?></td>
                                    <td><?php echo htmlspecialchars($question['question_text']); ?></td>
                                    <td><?php echo htmlspecialchars($question['option_A']); ?></td>
                                    <td><?php echo htmlspecialchars($question['option_B']); ?></td>
                                    <td><?php echo htmlspecialchars($question['option_C']); ?></td>
                                    <td><?php echo htmlspecialchars($question['option_D']); ?></td>
                                    <td><?php echo htmlspecialchars($question['correct_option']); ?></td>
                                    <td>
                                        <!-- Edit functionality can be added similarly -->
                                        <a href="addranked.php?action=manage_questions&id=<?php echo $ranked_quiz_id; ?>&delete_question_id=<?php echo urlencode($question['question_id']); ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this question?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No questions found for this quiz level.</p>
                <?php endif; ?>
            </div>
        </body>
        </html>
        <?php
        break;

    case 'list_levels':
    default:
        // Fetch all quiz levels
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

        // Fetch any messages from URL
        if (isset($_GET['error'])) {
            $error = htmlspecialchars($_GET['error']);
        }
        if (isset($_GET['success'])) {
            $success = htmlspecialchars($_GET['success']);
        }

        // Display list of quiz levels
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Manage Quiz Levels</title>
            <link rel="stylesheet" href="addranked.css">
        </head>
        <body>
            <div class="container">
                <h1>Manage Quiz Levels</h1>

                <?php if (!empty($error)): ?>
                    <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <div class="alert success"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>

                <div class="actions">
                    <a href="addranked.php?action=add_level" class="btn">Add New Quiz Level</a>
                </div>

                <?php if (!empty($levels)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Quiz Level</th>
                                <th>Quiz Name</th>
                                <th>Duration (mins)</th>
                                <th>Total Score</th>
                                <th>Status</th>
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
                                    <td><?php echo $level['is_published'] ? 'Published' : 'Unpublished'; ?></td>
                                    <td>
                                        <a href="addranked.php?action=edit_level&id=<?php echo $level['ranked_quiz_id']; ?>" class="btn">Edit</a>
                                        <a href="addranked.php?action=delete_level&id=<?php echo $level['ranked_quiz_id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this quiz level? All associated questions will be deleted.')">Delete</a>
                                        <?php if (!$level['is_published']): ?>
                                            <a href="addranked.php?action=publish_level&id=<?php echo $level['ranked_quiz_id']; ?>" class="btn publish-btn" onclick="return confirm('Are you sure you want to publish this quiz level? It will be available to students.')">Publish</a>
                                        <?php else: ?>
                                            <span class="published-label">Published</span>
                                        <?php endif; ?>
                                        <a href="addranked.php?action=manage_questions&id=<?php echo $level['ranked_quiz_id']; ?>" class="btn">Manage Questions</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No quiz levels found. Please add a new quiz level.</p>
                <?php endif; ?>
            </div>
        </body>
        </html>
        <?php
        break;
}

// Close the database connection
$conn->close();
?>
