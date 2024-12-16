<?php
// quiz_code.php

// Start the session to handle flash messages
session_start();

// Include the database connection
require_once 'connection.php';

// Initialize variables for error and success messages
$error = '';
$success = '';

// Function to generate a unique question ID
function generateQuestionId($connection) {
    do {
        // Generate a unique ID (11 characters)
        $question_id = substr(uniqid('', true), 0, 11);
        // Check if the generated ID already exists
        $stmt = $connection->prepare("SELECT COUNT(*) FROM questions WHERE question_id = ?");
        $stmt->bind_param("s", $question_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    } while ($count > 0); // Repeat if ID already exists

    return $question_id;
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize quiz name and description
    $quiz_name = trim($_POST['quiz_name']);
    $quiz_description = trim($_POST['quiz_description']);

    // Retrieve questions
    $questions = isset($_POST['questions']) ? $_POST['questions'] : [];

    // Validate quiz name and description
    if (empty($quiz_name)) {
        $error = "Quiz name is required.";
    } elseif (empty($quiz_description)) {
        $error = "Quiz description is required.";
    } elseif (empty($questions)) {
        $error = "At least one question is required.";
    } else {
        // Further validate each question
        foreach ($questions as $index => $q) {
            if (empty(trim($q['question_text']))) {
                $error = "Question " . ($index + 1) . " text is required.";
                break;
            }
            if (empty(trim($q['option_A'])) || empty(trim($q['option_B'])) || empty(trim($q['option_C'])) || empty(trim($q['option_D']))) {
                $error = "All options (A, B, C, D) for Question " . ($index + 1) . " are required.";
                break;
            }
            if (empty($q['correct_option']) || !in_array($q['correct_option'], ['A', 'B', 'C', 'D'])) {
                $error = "A valid correct option is required for Question " . ($index + 1) . ".";
                break;
            }
        }
    }

    // If no validation errors, proceed to insert into the database
    if (empty($error)) {
        // Begin transaction
        $connection->begin_transaction();

        try {
            // Insert into quizzes table
            $stmt = $connection->prepare("INSERT INTO quizzes (quiz_name, quiz_description) VALUES (?, ?)");
            $stmt->bind_param("ss", $quiz_name, $quiz_description);
            if (!$stmt->execute()) {
                throw new Exception("Failed to create quiz: " . $stmt->error);
            }
            // Get the inserted quiz_id
            $quiz_id = $stmt->insert_id;
            $stmt->close();

            // Prepare the statement for inserting questions
            $stmt = $connection->prepare("INSERT INTO questions (question_id, question_no, question_text, option_A, option_B, option_C, option_D, correct_option, quiz_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Iterate through each question and insert
            foreach ($questions as $index => $q) {
                $question_no = $index + 1;
                $question_text = trim($q['question_text']);
                $option_A = trim($q['option_A']);
                $option_B = trim($q['option_B']);
                $option_C = trim($q['option_C']);
                $option_D = trim($q['option_D']);
                $correct_option = $q['correct_option'];

                // Generate a unique question_id
                $question_id = generateQuestionId($connection);

                // Bind parameters
                $stmt->bind_param("sissssssi", $question_id, $question_no, $question_text, $option_A, $option_B, $option_C, $option_D, $correct_option, $quiz_id);

                // Execute the statement
                if (!$stmt->execute()) {
                    throw new Exception("Failed to insert Question " . $question_no . ": " . $stmt->error);
                }
            }

            // Close the statement
            $stmt->close();

            // Commit the transaction
            $connection->commit();

            // Set success message
            $success = "Quiz '{$quiz_name}' created successfully with " . count($questions) . " questions.";

            // Optionally, you can redirect to a different page
            // header("Location: create_quiz.php?success=" . urlencode($success));
            // exit();

        } catch (Exception $e) {
            // Rollback the transaction on error
            $connection->rollback();
            $error = $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Custom Quiz</title>
    <link rel="stylesheet" href="Add-CustomQuiz.css">
    <script src="Add-CustomQuiz.js" defer></script>
    <?php include '../Constants/Combine-educator.php' ?>
</head>

<script>
        // JavaScript to handle adding and removing questions dynamically
        document.addEventListener('DOMContentLoaded', function () {
            const addQuestionBtn = document.getElementById('addQuestionBtn');
            const questionsContainer = document.getElementById('questionsContainer');

            addQuestionBtn.addEventListener('click', function () {
                const questionCount = document.querySelectorAll('.question-block').length;
                const newIndex = questionCount;

                const questionBlock = document.createElement('div');
                questionBlock.classList.add('question-block');

                questionBlock.innerHTML = `
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

                questionsContainer.appendChild(questionBlock);
            });

            // Event delegation for removing questions
            questionsContainer.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-question')) {
                    e.target.parentElement.remove();
                    // Optionally, re-number the remaining questions
                    const questionBlocks = document.querySelectorAll('.question-block');
                    questionBlocks.forEach((block, index) => {
                        block.querySelector('h3').textContent = `Question ${index + 1}`;
                        // Update name attributes
                        const inputs = block.querySelectorAll('input, textarea, select');
                        inputs.forEach(input => {
                            const name = input.getAttribute('name');
                            const newName = name.replace(/\d+/, index);
                            input.setAttribute('name', newName);
                        });
                    });
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Create a New Custom Quiz</h1>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form action="quiz_code.php" method="POST" id="quizForm">
            <div class="form-group">
                <label for="quiz_name">Quiz Name:</label>
                <input type="text" id="quiz_name" name="quiz_name" required value="<?php echo isset($_POST['quiz_name']) ? htmlspecialchars($_POST['quiz_name']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="quiz_description">Quiz Description:</label>
                <textarea id="quiz_description" name="quiz_description" rows="4" required><?php echo isset($_POST['quiz_description']) ? htmlspecialchars($_POST['quiz_description']) : ''; ?></textarea>
            </div>

            <h2>Questions</h2>
            <div id="questionsContainer">
                <?php
                // If form was submitted with errors, repopulate questions
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($questions)) {
                    foreach ($questions as $index => $q) {
                ?>
                        <div class="question-block">
                            <h3>Question <?php echo $index + 1; ?></h3>
                            <div class="form-group">
                                <label>Question Text:</label>
                                <textarea name="questions[<?php echo $index; ?>][question_text]" rows="3" required><?php echo htmlspecialchars($q['question_text']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Option A:</label>
                                <input type="text" name="questions[<?php echo $index; ?>][option_A]" required value="<?php echo htmlspecialchars($q['option_A']); ?>">
                            </div>
                            <div class="form-group">
                                <label>Option B:</label>
                                <input type="text" name="questions[<?php echo $index; ?>][option_B]" required value="<?php echo htmlspecialchars($q['option_B']); ?>">
                            </div>
                            <div class="form-group">
                                <label>Option C:</label>
                                <input type="text" name="questions[<?php echo $index; ?>][option_C]" required value="<?php echo htmlspecialchars($q['option_C']); ?>">
                            </div>
                            <div class="form-group">
                                <label>Option D:</label>
                                <input type="text" name="questions[<?php echo $index; ?>][option_D]" required value="<?php echo htmlspecialchars($q['option_D']); ?>">
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
</body>

</html>