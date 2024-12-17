<?php
// StartQuiz.php

// Start Output Buffering to prevent "headers already sent" errors
ob_start();
session_start();

// Include the database connection file
require '../Database/connection.php';

// Ensure the student is logged in
// if (!isset($_SESSION['student_id'])) {
//     header("Location: student_login.php"); // Redirect to the login page
//     exit();
// }

// Initialize variables
$error = '';
$success = '';
$quiz_level = [];
$questions = [];

// Get the ranked_quiz_id from the GET parameter
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $ranked_quiz_id = (int)$_GET['id'];
} else {
    header("Location: viewAll-Level.php?error=invalid_quiz_id");
    exit();
}

// Handle POST request (Quiz Submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the quiz start time from the session
    if (isset($_SESSION['quiz_start_time'])) {
        $quiz_start_time = $_SESSION['quiz_start_time'];
    } else {
        $quiz_start_time = time(); // Fallback to current time if not set
    }

    // Calculate time taken in minutes
    $time_taken = ceil((time() - $quiz_start_time) / 60);

    // Get the student ID from the session
    $student_id = (int)$_SESSION['student_id'];

    // Retrieve the submitted answers from POST
    $userAnswers = isset($_POST['answers']) ? $_POST['answers'] : [];

    // Check if the student has already submitted this quiz
    $check_stmt = $conn->prepare("SELECT COUNT(*) FROM ranked_quiz_submission WHERE ranked_quiz_id = ? AND student_id = ?");
    if ($check_stmt) {
        $check_stmt->bind_param("ii", $ranked_quiz_id, $student_id);
        $check_stmt->execute();
        $check_stmt->bind_result($submission_count);
        $check_stmt->fetch();
        $check_stmt->close();

        if ($submission_count > 0) {
            $error = "You have already submitted this quiz.";
        }
    } else {
        $error = "Database error: " . $conn->error;
    }

    // Proceed only if there are answers and no prior submission
    if (empty($error) && !empty($userAnswers)) {
        // Prepare question IDs and ensure they are integers
        $questionIds = array_map('intval', array_keys($userAnswers));
        $placeholders = implode(',', array_fill(0, count($questionIds), '?'));

        // Prepare SQL to fetch correct answers
        $sql = "SELECT question_id, correct_option FROM questions WHERE question_id IN ($placeholders) AND ranked_quiz_id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters dynamically
            $types = str_repeat('i', count($questionIds)) . 'i'; // All integers
            $params = $questionIds;
            $params[] = $ranked_quiz_id;
            $stmt->bind_param($types, ...$params);

            // Execute the statement
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $correctAnswers = [];

                // Fetch correct answers
                while ($row = $result->fetch_assoc()) {
                    $correctAnswers[$row['question_id']] = strtoupper($row['correct_option']);
                }
                $stmt->close();

                // Fetch the total score for the quiz
                $score_stmt = $conn->prepare("SELECT ranked_score FROM ranked_quiz_levels WHERE ranked_quiz_id = ?");
                if ($score_stmt) {
                    $score_stmt->bind_param("i", $ranked_quiz_id);
                    $score_stmt->execute();
                    $score_stmt->bind_result($quiz_total_score);
                    $score_stmt->fetch();
                    $score_stmt->close();
                } else {
                    $error = "Database error: " . $conn->error;
                }

                // Calculate the points per correct answer
                $total_questions = count($correctAnswers);
                if ($total_questions > 0) {
                    $points_per_question = $quiz_total_score / $total_questions;
                } else {
                    $points_per_question = 0;
                }

                // Calculate the student's score
                $score = 0;
                foreach ($userAnswers as $qid => $selected_option) {
                    $qid = (int)$qid;
                    $selected_option = strtoupper(trim($selected_option));

                    if (isset($correctAnswers[$qid]) && $selected_option === $correctAnswers[$qid]) {
                        $score += $points_per_question;
                    }
                }

                // Round the score to two decimal places
                $score = round($score, 2);

                // Insert the submission into ranked_quiz_submission
                $insert_stmt = $conn->prepare("INSERT INTO ranked_quiz_submission (ranked_quiz_id, student_id, score, time_taken_ranked) VALUES (?, ?, ?, ?)");
                if ($insert_stmt) {
                    $insert_stmt->bind_param("iiii", $ranked_quiz_id, $student_id, $score, $time_taken);

                    if ($insert_stmt->execute()) {
                        $success = "You scored $score out of $quiz_total_score.";
                    } else {
                        // Handle potential duplicate submissions or other errors
                        if ($conn->errno == 1062) { // Duplicate entry
                            $error = "You have already submitted this quiz.";
                        } else {
                            $error = "Error recording your submission: " . $insert_stmt->error;
                        }
                    }
                    $insert_stmt->close();
                } else {
                    $error = "Database error: " . $conn->error;
                }
            } else {
                $error = "Database error: " . $stmt->error;
            }
        } else {
            $error = "Database error: " . $conn->error;
        }
    } elseif (empty($userAnswers)) {
        $error = "No answers submitted.";
    }

    // Clear the quiz start time from the session
    unset($_SESSION['quiz_start_time']);
} else {
    // Handle GET request (Display Quiz)

    // Fetch quiz level details
    $quiz_stmt = $conn->prepare("SELECT ranked_quiz_level, ranked_quiz_name, ranked_quiz_duration, ranked_score FROM ranked_quiz_levels WHERE ranked_quiz_id = ?");
    if ($quiz_stmt) {
        $quiz_stmt->bind_param("i", $ranked_quiz_id);
        $quiz_stmt->execute();
        $quiz_stmt->bind_result($ranked_quiz_level, $ranked_quiz_name, $ranked_quiz_duration, $ranked_score);
        if ($quiz_stmt->fetch()) {
            $quiz_level = [
                'ranked_quiz_level' => $ranked_quiz_level,
                'ranked_quiz_name' => $ranked_quiz_name,
                'ranked_quiz_duration' => $ranked_quiz_duration,
                'ranked_score' => $ranked_score
            ];
        } else {
            $error = "Quiz not found.";
        }
        $quiz_stmt->close();
    } else {
        $error = "Database error: " . $conn->error;
    }

    // Fetch all questions for this quiz level
    if (empty($error)) {
        $questions_stmt = $conn->prepare("SELECT question_id, question_no, question_text, option_A, option_B, option_C, option_D FROM questions WHERE ranked_quiz_id = ? ORDER BY question_no ASC");
        if ($questions_stmt) {
            $questions_stmt->bind_param("i", $ranked_quiz_id);
            $questions_stmt->execute();
            $questions_result = $questions_stmt->get_result();

            while ($row = $questions_result->fetch_assoc()) {
                $questions[] = $row;
            }

            $questions_stmt->close();
        } else {
            $error = "Database error: " . $conn->error;
        }
    }

    // Set the quiz start time in the session
    $_SESSION['quiz_start_time'] = time();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Start Quiz - <?php echo htmlspecialchars($quiz_level['ranked_quiz_level'] . " - " . $quiz_level['ranked_quiz_name']); ?></title>
    <link rel="stylesheet" href="StartQuiz.css"> <!-- Ensure this CSS file exists and is properly linked -->
    
    <script>
        // Countdown Timer (only for GET requests and if no submission has been made)
        <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST' && empty($success) && empty($error)): ?>
        var remainingTime = <?php echo htmlspecialchars($quiz_level['ranked_quiz_duration'] * 60); ?>; // Convert minutes to seconds

        function startTimer() {
            var timerElement = document.getElementById('timer');
            var interval = setInterval(function() {
                var minutes = Math.floor(remainingTime / 60);
                var seconds = remainingTime % 60;
                timerElement.textContent = minutes + "m " + seconds + "s ";

                if (remainingTime <= 0) {
                    clearInterval(interval);
                    alert("Time is up! Your quiz will be submitted automatically.");
                    document.getElementById('quiz-form').submit();
                }
                remainingTime--;
            }, 1000);
        }

        window.onload = startTimer;
        <?php endif; ?>
    </script>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($quiz_level['ranked_quiz_level'] . " - " . $quiz_level['ranked_quiz_name']); ?></h1>
        <p>Duration: <?php echo htmlspecialchars($quiz_level['ranked_quiz_duration']); ?> minutes | Total Score: <?php echo htmlspecialchars($quiz_level['ranked_score']); ?></p>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
            <a href="viewAll-Level.php" class="btn">Back to Quiz Levels</a>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?php echo htmlspecialchars($success); ?></div>
            <a href="viewAll-Level.php" class="btn">Back to Quiz Levels</a>
        <?php endif; ?>

        <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST' && empty($success) && empty($error)): ?>
            <div class="timer">Time Remaining: <span id="timer">Loading...</span></div>
            <form action="StartQuiz.php?id=<?php echo htmlspecialchars($ranked_quiz_id); ?>" method="POST" id="quiz-form">
                <?php foreach ($questions as $question): ?>
                    <div class="question-block">
                        <p class="question"><?php echo htmlspecialchars($question['question_no'] . ". " . $question['question_text']); ?></p>
                        <div class="answers">
                            <?php
                                $options = [
                                    'A' => $question['option_A'],
                                    'B' => $question['option_B'],
                                    'C' => $question['option_C'],
                                    'D' => $question['option_D'],
                                ];
                                foreach ($options as $key => $option_text):
                            ?>
                                <label>
                                    <input type="radio" name="answers[<?php echo htmlspecialchars($question['question_id']); ?>]" value="<?php echo htmlspecialchars($key); ?>" required>
                                    <?php echo htmlspecialchars($option_text); ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <a href="History.php">
                    <button type="submit" class="btn submit-btn">Submit Quiz</button>
                </a>
                <a href="viewAll-Level.php" class="btn">Back to Quiz Levels</a>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Flush the output buffer
ob_end_flush();
?>
