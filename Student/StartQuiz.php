<?php
// Student/StartQuiz.php

session_start();

// Include DB connection
require '../Database/connection.php';

// Check if student is logged in
// if (!isset($_SESSION['student_username'])) {
//     header("Location: student_login.php"); // Redirect to student login page
//     exit();
// }

// Initialize variables
$error = '';
$success = '';
$quiz_level = [];
$questions = [];

// Get the quiz level ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $ranked_quiz_id = (int)$_GET['id'];
} else {
    header("Location: viewAll-Level.php?error=invalid_quiz_id");
    exit();
}

// Handle POST request (quiz submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the quiz start time from session
    if (isset($_SESSION['quiz_start_time'])) {
        $quiz_start_time = $_SESSION['quiz_start_time'];
    } else {
        $quiz_start_time = time(); // Fallback to current time
    }
    $time_taken = ceil((time() - $quiz_start_time) / 60); // Time taken in minutes

    // Get student ID from session (ensure it's set during login)
    $student_id = isset($_SESSION['student_id']) ? $_SESSION['student_id'] : 0;

    // Get the answers from POST
    $userAnswers = isset($_POST['answers']) ? $_POST['answers'] : [];

    // Fetch correct answers from the database
    if (!empty($userAnswers)) {
        // Prepare question IDs
        $questionIds = array_keys($userAnswers);
        $placeholders = implode(',', array_fill(0, count($questionIds), '?'));
        
        // Prepare SQL to get correct answers
        $sql = "SELECT question_id, correct_option FROM questions WHERE question_id IN ($placeholders) AND ranked_quiz_id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            // Bind parameters
            $types = str_repeat('s', count($questionIds)) . 'i'; // strings + integer
            $params = $questionIds;
            $params[] = $ranked_quiz_id;
            $stmt->bind_param($types, ...$params);
            
            // Execute and get results
            $stmt->execute();
            $result = $stmt->get_result();
            $correctAnswers = [];
            while ($row = $result->fetch_assoc()) {
                $correctAnswers[$row['question_id']] = strtoupper($row['correct_option']);
            }
            $stmt->close();
            
            // Calculate score
            $score = 0;
            foreach ($userAnswers as $qid => $selected_option) {
                if (isset($correctAnswers[$qid]) && strtoupper($selected_option) === $correctAnswers[$qid]) {
                    $score++;
                }
            }
            
            // Insert into ranked_quiz_submission table
            $stmt = $conn->prepare("INSERT INTO ranked_quiz_submission (student_id, ranked_quiz_id) VALUES (?, ?)");
            if ($stmt) {
                $stmt->bind_param("ii", $student_id, $ranked_quiz_id);
                if ($stmt->execute()) {
                    $success = "You scored $score out of " . count($correctAnswers) . ".";
                } else {
                    $error = "Error recording your submission: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $error = "Database error: " . $conn->error;
            }
        } else {
            $error = "Database error: " . $conn->error;
        }
    } else {
        $error = "No answers submitted.";
    }

    // Clear quiz start time from session
    unset($_SESSION['quiz_start_time']);
} else {
    // GET request - display the quiz
    // Fetch quiz level details
    $stmt = $conn->prepare("SELECT * FROM ranked_quiz_levels WHERE ranked_quiz_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $ranked_quiz_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows !== 1) {
            header("Location: viewAll-Level.php?error=quiz_not_found");
            exit();
        }
        $quiz_level = $result->fetch_assoc();
        $stmt->close();
    } else {
        $error = "Database error: " . $conn->error;
    }

    // Fetch all questions for this quiz level
    $stmt = $conn->prepare("SELECT * FROM questions WHERE ranked_quiz_id = ? ORDER BY question_no ASC");
    if ($stmt) {
        $stmt->bind_param("i", $ranked_quiz_id);
        $stmt->execute();
        $result_questions = $stmt->get_result();
        while ($row = $result_questions->fetch_assoc()) {
            $questions[] = $row;
        }
        $stmt->close();
    } else {
        $error = "Database error: " . $conn->error;
    }

    // Set quiz start time in session
    $_SESSION['quiz_start_time'] = time();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Start Quiz - <?php echo htmlspecialchars($quiz_level['ranked_quiz_level'] . " - " . $quiz_level['ranked_quiz_name']); ?></title>
    <link rel="stylesheet" href="StartQuiz.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($quiz_level['ranked_quiz_level'] . " - " . $quiz_level['ranked_quiz_name']); ?></h1>
        <p>Duration: <?php echo htmlspecialchars($quiz_level['ranked_quiz_duration']); ?> minutes | Total Score: <?php echo htmlspecialchars($quiz_level['ranked_score']); ?></p>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?php echo htmlspecialchars($success); ?></div>
            <a href="viewAll-Level.php" class="btn">Back to Quiz Levels</a>
        <?php else: ?>
            <form action="StartQuiz.php?id=<?php echo $ranked_quiz_id; ?>" method="POST" id="quiz-form">
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
                                <label class="answer-option">
                                    <input type="radio" name="answers[<?php echo htmlspecialchars($question['question_id']); ?>]" value="<?php echo htmlspecialchars($key); ?>" required>
                                    <?php echo htmlspecialchars($option_text); ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="btn submit-btn">Submit Quiz</button>
                <a href="viewAll-Level.php" class="btn">Back to Quiz Levels</a>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
