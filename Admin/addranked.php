<?php
// Add-CustomQuiz.php

// Start Output Buffering to prevent "headers already sent" errors
ob_start();
session_start();

// Include the database connection file
require '../Database/connection.php';

// Include educator environment file if needed
include '../Constants/Combine-admin.php'; // Adjust the path if necessary

// Ensure the educator is logged in
if (!isset($_SESSION['educator_id'])) {
    header("Location: educator_login.php"); // Redirect to the login page
    exit();
}

// Initialize variables
$error = '';
$success = '';
$questions_data = [];

// Function to generate a unique 4-digit quiz code
function generateQuizCode($connection) {
    do {
        $quiz_code = rand(1000, 9999); // Generates a random 4-digit number
        $count = 0; // Initialize count

        // Check if the quiz_code already exists
        $stmt = $connection->prepare("SELECT COUNT(*) FROM custom_quiz WHERE quiz_code = ?");
        if ($stmt) {
            $stmt->bind_param("i", $quiz_code);
            if ($stmt->execute()) {
                $stmt->bind_result($count);
                $stmt->fetch();
            } else {
                // Handle execute error
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }
            $stmt->close();
        } else {
            // Handle prepare error
            throw new Exception("Prepare failed: (" . $connection->errno . ") " . $connection->error);
        }

    } while ($count > 0); // Repeat if code already exists

    return $quiz_code;
}


// Function to generate a unique question ID
function generateQuestionId($connection) {
    do {
        // Generate a unique ID (11 characters)
        $question_id = substr(uniqid('', true), 0, 11);
        $count = 0; // Initialize count

        // Check if the generated ID already exists
        $stmt = $connection->prepare("SELECT COUNT(*) FROM questions WHERE question_id = ?");
        if ($stmt) {
            $stmt->bind_param("s", $question_id);
            if ($stmt->execute()) {
                $stmt->bind_result($count);
                $stmt->fetch();
            } else {
                // Handle execute error
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }
            $stmt->close();
        } else {
            // Handle prepare error
            throw new Exception("Prepare failed: (" . $connection->errno . ") " . $connection->error);
        }

    } while ($count > 0); // Repeat if ID already exists

    return $question_id;
}


// Handle POST request (Quiz Submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize quiz name and description
    $quiz_name = isset($_POST['quiz_name']) ? trim($_POST['quiz_name']) : '';
    $quiz_description = isset($_POST['quiz_description']) ? trim($_POST['quiz_description']) : '';

    // Retrieve questions
    $questions = isset($_POST['questions']) && is_array($_POST['questions']) ? $_POST['questions'] : [];

    // Basic validation
    if (empty($quiz_name)) {
        $error = "Quiz Name is required.";
    } elseif (empty($quiz_description)) {
        $error = "Quiz Description is required.";
    } elseif (empty($questions)) {
        $error = "At least one question is required.";
    } else {
        // Validate each question
        foreach ($questions as $index => $q) {
            $q_text = isset($q['question_text']) ? trim($q['question_text']) : '';
            $q_optionA = isset($q['option_A']) ? trim($q['option_A']) : '';
            $q_optionB = isset($q['option_B']) ? trim($q['option_B']) : '';
            $q_optionC = isset($q['option_C']) ? trim($q['option_C']) : '';
            $q_optionD = isset($q['option_D']) ? trim($q['option_D']) : '';
            $q_correct = isset($q['correct_option']) ? trim($q['correct_option']) : '';

            if (empty($q_text) || empty($q_optionA) || empty($q_optionB) || empty($q_optionC) || empty($q_optionD) || empty($q_correct)) {
                $error = "All fields are required for each question (Question " . ($index + 1) . ").";
                break;
            }

            if (!in_array($q_correct, ['A', 'B', 'C', 'D'])) {
                $error = "Please select a valid correct option (A, B, C, or D) for Question " . ($index + 1) . ".";
                break;
            }
        }
    }

    // If no validation errors, proceed with database insert
    if (empty($error)) {
        // Begin transaction
        $connection->begin_transaction();

        try {
            // Generate a unique 4-digit quiz code
            $quiz_code = generateQuizCode($connection);

            // Set a default score for the quiz (you can modify this as needed)
            $custom_quiz_score = 100;

            // Get the educator_id from the session
            $educator_id = (int)$_SESSION['educator_id'];

            // Insert into custom_quiz table
            $insert_quiz_sql = "INSERT INTO custom_quiz (quiz_name, quiz_description, quiz_code, custom_quiz_score, educator_id) VALUES (?, ?, ?, ?, ?)";
            $stmt_quiz = $connection->prepare($insert_quiz_sql);
            if (!$stmt_quiz) {
                throw new Exception("Database error preparing quiz insert: " . $connection->error);
            }

            $stmt_quiz->bind_param("ssiii", $quiz_name, $quiz_description, $quiz_code, $custom_quiz_score, $educator_id);
            if (!$stmt_quiz->execute()) {
                throw new Exception("Database error inserting quiz: " . $stmt_quiz->error);
            }

            // Get the inserted quiz_id
            $new_quiz_id = $stmt_quiz->insert_id;
            $stmt_quiz->close();

            // Insert questions into questions table
            $insert_question_sql = "INSERT INTO questions (question_id, question_no, question_text, option_A, option_B, option_C, option_D, correct_option, ranked_quiz_id, quiz_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NULL, ?)";
            $stmt_question = $connection->prepare($insert_question_sql);

            if (!$stmt_question) {
                throw new Exception("Database error preparing questions insert: " . $connection->error);
            }

            foreach ($questions as $index => $q) {
                $question_no = $index + 1;
                $question_text = trim($q['question_text']);
                $option_A = trim($q['option_A']);
                $option_B = trim($q['option_B']);
                $option_C = trim($q['option_C']);
                $option_D = trim($q['option_D']);
                $correct_option = strtoupper(trim($q['correct_option']));

                // Generate a unique question_id
                $question_id = generateQuestionId($connection);

                // Bind parameters
                $stmt_question->bind_param(
                    "sissssssi",
                    $question_id,       // question_id
                    $question_no,       // question_no
                    $question_text,     // question_text
                    $option_A,          // option_A
                    $option_B,          // option_B
                    $option_C,          // option_C
                    $option_D,          // option_D
                    $correct_option,    // correct_option
                    $new_quiz_id        // quiz_id
                );

                // Execute the statement
                if (!$stmt_question->execute()) {
                    throw new Exception("Database error inserting Question " . $question_no . ": " . $stmt_question->error);
                }
            }

            // Close the statement
            $stmt_question->close();

            // Commit the transaction
            $connection->commit();

            // Set success message
            $success = "Quiz '{$quiz_name}' created successfully with Quiz Code: <strong>{$quiz_code}</strong>.";
            // Optionally, you can redirect to a different page
            // header("Location: add_custom_quiz.php?success=" . urlencode($success));
            // exit();

        } catch (Exception $e) {
            // Rollback the transaction on error
            $connection->rollback();
            $error = $e->getMessage();
        }
    }

    // Close the database connection
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Custom Quiz</title>
    <link rel="stylesheet" href="Add-CustomQuiz.css"> <!-- Ensure this CSS file exists and is properly linked -->
    <style>
        /* Basic styling for demonstration purposes */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 25px;
            border-radius: 5px;
            max-width: 800px;
            margin: auto;
        }

        h1, h2, h3 {
            text-align: center;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }

        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert.success {
            background-color: #d4edda;
            color: #155724;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            opacity: 0.9;
        }

        .remove-question {
            background-color: #dc3545;
            margin-top: 10px;
        }

        hr {
            border: 1px solid #ccc;
            margin: 20px 0;
        }

        #addQuestionBtn {
            background-color: #28a745;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Create a New Custom Quiz</h1>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="Add-CustomQuiz.php" method="POST" id="quizForm">
            <div class="form-group">
                <label for="quiz_name">Quiz Name:</label>
                <input type="text" id="quiz_name" name="quiz_name" required value="<?php echo isset($_POST['quiz_name']) ? htmlspecialchars($_POST['quiz_name'], ENT_QUOTES, 'UTF-8') : ''; ?>">
            </div>

            <div class="form-group">
                <label for="quiz_description">Quiz Description:</label>
                <textarea id="quiz_description" name="quiz_description" rows="4" required><?php echo isset($_POST['quiz_description']) ? htmlspecialchars($_POST['quiz_description'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
            </div>

            <h2>Questions</h2>
            <div id="questionsContainer">
                <?php
                // If form was submitted with errors, repopulate questions
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['questions'])) {
                    foreach ($_POST['questions'] as $index => $q) {
                ?>
                        <div class="question-block">
                            <h3>Question <?php echo $index + 1; ?></h3>
                            <div class="form-group">
                                <label>Question Text:</label>
                                <textarea name="questions[<?php echo $index; ?>][question_text]" rows="3" required><?php echo htmlspecialchars($q['question_text'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Option A:</label>
                                <input type="text" name="questions[<?php echo $index; ?>][option_A]" required value="<?php echo htmlspecialchars($q['option_A'], ENT_QUOTES, 'UTF-8'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Option B:</label>
                                <input type="text" name="questions[<?php echo $index; ?>][option_B]" required value="<?php echo htmlspecialchars($q['option_B'], ENT_QUOTES, 'UTF-8'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Option C:</label>
                                <input type="text" name="questions[<?php echo $index; ?>][option_C]" required value="<?php echo htmlspecialchars($q['option_C'], ENT_QUOTES, 'UTF-8'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Option D:</label>
                                <input type="text" name="questions[<?php echo $index; ?>][option_D]" required value="<?php echo htmlspecialchars($q['option_D'], ENT_QUOTES, 'UTF-8'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Correct Option:</label>
                                <select name="questions[<?php echo $index; ?>][correct_option]" required>
                                    <option value="">--Select Correct Option--</option>
                                    <option value="A" <?php if (isset($q['correct_option']) && $q['correct_option'] === 'A') echo 'selected'; ?>>A</option>
                                    <option value="B" <?php if (isset($q['correct_option']) && $q['correct_option'] === 'B') echo 'selected'; ?>>B</option>
                                    <option value="C" <?php if (isset($q['correct_option']) && $q['correct_option'] === 'C') echo 'selected'; ?>>C</option>
                                    <option value="D" <?php if (isset($q['correct_option']) && $q['correct_option'] === 'D') echo 'selected'; ?>>D</option>
                                </select>
                            </div>
                            <button type="button" class="remove-question">Remove Question</button>
                            <hr>
                        </div>
                    <?php
                    }
                } else {
                    // Default 5 question blocks
                    for ($i = 0; $i < 5; $i++) {
                    ?>
                        <div class="question-block">
                            <h3>Question <?php echo $i + 1; ?></h3>
                            <div class="form-group">
                                <label>Question Text:</label>
                                <textarea name="questions[<?php echo $i; ?>][question_text]" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Option A:</label>
                                <input type="text" name="questions[<?php echo $i; ?>][option_A]" required>
                            </div>
                            <div class="form-group">
                                <label>Option B:</label>
                                <input type="text" name="questions[<?php echo $i; ?>][option_B]" required>
                            </div>
                            <div class="form-group">
                                <label>Option C:</label>
                                <input type="text" name="questions[<?php echo $i; ?>][option_C]" required>
                            </div>
                            <div class="form-group">
                                <label>Option D:</label>
                                <input type="text" name="questions[<?php echo $i; ?>][option_D]" required>
                            </div>
                            <div class="form-group">
                                <label>Correct Option:</label>
                                <select name="questions[<?php echo $i; ?>][correct_option]" required>
                                    <option value="">--Select Correct Option--</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                            <button type="button" class="remove-question">Remove Question</button>
                            <hr>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <button type="button" id="addQuestionBtn">Add More Questions</button>

            <div class="form-group">
                <button type="submit">Create Quiz</button>
            </div>
        </form>
    </div>

    <!-- JavaScript Section -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addQuestionBtn = document.getElementById('addQuestionBtn');
            const questionsContainer = document.getElementById('questionsContainer');
            const quizForm = document.getElementById('quizForm');

            // Function to update the numbering of questions
            function updateQuestionNumbers() {
                const questionBlocks = document.querySelectorAll('.question-block');
                questionBlocks.forEach((block, index) => {
                    const heading = block.querySelector('h3');
                    heading.textContent = `Question ${index + 1}`;
                });
            }

            // Event delegation for removing questions
            questionsContainer.addEventListener('click', function (event) {
                if (event.target && event.target.classList.contains('remove-question')) {
                    event.preventDefault();
                    const questionBlock = event.target.closest('.question-block');
                    if (questionBlock) {
                        questionBlock.remove();
                        updateQuestionNumbers();
                        // Update name attributes for remaining questions
                        const remainingQuestions = document.querySelectorAll('.question-block');
                        remainingQuestions.forEach((block, index) => {
                            block.querySelectorAll('textarea, input[type="text"], select').forEach(input => {
                                // Update the name attribute to reflect the new index
                                const nameParts = input.name.split('[');
                                nameParts[1] = index + '][' + nameParts[1].split(']')[0] + '][' + nameParts[1].split(']')[1];
                                input.name = nameParts.join('[');
                            });
                        });
                    }
                }
            });

            // Function to add a new question block
            function addQuestion() {
                const questionCount = document.querySelectorAll('.question-block').length;
                const newIndex = questionCount;

                const newQuestionBlock = document.createElement('div');
                newQuestionBlock.classList.add('question-block');

                newQuestionBlock.innerHTML = `
                    <h3>Question ${newIndex + 1}</h3>
                    <div class="form-group">
                        <label>Question Text:</label>
                        <textarea name="questions[${newIndex}][question_text]" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Option A:</label>
                        <input type="text" name="questions[${newIndex}][option_A]" required>
                    </div>
                    <div class="form-group">
                        <label>Option B:</label>
                        <input type="text" name="questions[${newIndex}][option_B]" required>
                    </div>
                    <div class="form-group">
                        <label>Option C:</label>
                        <input type="text" name="questions[${newIndex}][option_C]" required>
                    </div>
                    <div class="form-group">
                        <label>Option D:</label>
                        <input type="text" name="questions[${newIndex}][option_D]" required>
                    </div>
                    <div class="form-group">
                        <label>Correct Option:</label>
                        <select name="questions[${newIndex}][correct_option]" required>
                            <option value="">--Select Correct Option--</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                    <button type="button" class="remove-question">Remove Question</button>
                    <hr>
                `;

                questionsContainer.appendChild(newQuestionBlock);
            }

            // Event listener for adding new questions
            addQuestionBtn.addEventListener('click', function () {
                addQuestion();
            });

            // Optional: Handle form submission with additional client-side validation or confirmation
            quizForm.addEventListener('submit', function (event) {
                // Example: Confirm submission
                // if (!confirm('Are you sure you want to create this quiz?')) {
                //     event.preventDefault();
                // }
            });
        });
    </script>
</body>

</html>

<?php
// Flush the output buffer
ob_end_flush();
?>
