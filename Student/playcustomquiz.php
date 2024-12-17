<?php
// playCustomQuiz.php

// **Explanation for 6-year-olds:**
// This PHP file lets players join a custom quiz by entering a 4-digit quiz code.
// It checks if the code is correct and sends them to the quiz if valid.

// Include required files
// **Explanation:** These files help with common features like database connections.
include '../Constants/Combine-student.php';
include '../Database/connection.php';

// Initialize variables
$quiz_code = ""; // This will store the quiz code entered by the user.
$error = "";     // This will store any error messages.

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Step 1: Get the quiz code from the form and remove extra spaces
    $quiz_code_input = trim($_POST['quiz_code'] ?? '');

    // Step 2: Validate the quiz code
    if (empty($quiz_code_input)) {
        $error = "Please enter a 4-digit quiz code."; // Error: No code entered.
    } elseif (!preg_match('/^\d{4}$/', $quiz_code_input)) {
        $error = "Quiz code must be exactly 4 digits."; // Error: Code is not 4 digits.
    } else {
        // Step 3: Check the database for the quiz code

        // **Explanation:** Prevent hacking by using a safe query.
        $stmt = $conn->prepare("SELECT quiz_id, quiz_name FROM custom_quiz WHERE quiz_code = ?");
        $stmt->bind_param("i", $quiz_code_input); // Bind the quiz code as a number.
        $stmt->execute();
        $stmt->bind_result($quiz_id, $quiz_name); // Get quiz ID and name if found.

        if ($stmt->fetch()) {
            // **Explanation:** Code is correct! Send them to the quiz page.
            header("Location: takeQuiz.php?quiz_id=" . urlencode($quiz_id));
            exit(); // Stop further code from running.
        } else {
            $error = "Invalid quiz code. Please try again."; // Error: Code not found.
        }

        $stmt->close(); // Clean up the query.
    }

    // now I would like you to make a playCustomQuiz.php, where users can start playing their custom quiz by simply putting down the `quiz_id` from the table `questions` when educator have added their levels and questions.

    $conn->close(); // Close the database connection.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play Custom Quiz</title>
    <link rel="stylesheet" href="../Student/student-css/playCustomQuiz.css">
</head>

<body>
    <div class="overlay">
        <!-- Main Content -->
        <div class="home_content">
            <div class="quiz-container">
                <h1>Join a Quiz</h1>

                <!-- Quiz form for entering the code -->
                <form action="playCustomQuiz.php" method="POST" class="quiz-form" id="quiz-form">
                    <div class="form-group">
                        <label for="quiz_code">Enter Custom Quiz Code</label>

                        <!-- Input boxes for entering 4 digits -->
                        <div class="quiz-code-inputs">
                            <input type="text" class="quiz-digit" maxlength="1" pattern="\d" required autocomplete="off" inputmode="numeric" />
                            <input type="text" class="quiz-digit" maxlength="1" pattern="\d" required autocomplete="off" inputmode="numeric" />
                            <input type="text" class="quiz-digit" maxlength="1" pattern="\d" required autocomplete="off" inputmode="numeric" />
                            <input type="text" class="quiz-digit" maxlength="1" pattern="\d" required autocomplete="off" inputmode="numeric" />
                        </div>

                        <!-- Show error messages, if any -->
                        <?php if (!empty($error)): ?>
                            <span class="error" style="color: red;">
                                <?php echo htmlspecialchars($error); ?>
                            </span>
                        <?php endif; ?>

                        <!-- Hidden input to store the full quiz code -->
                        <input type="hidden" name="quiz_code" id="hidden_quiz_code" value="<?php echo htmlspecialchars($quiz_code); ?>">
                    </div>

                    <button type="submit" class="btn">Join Quiz</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // **Explanation:**
        // This script makes entering the quiz code easier and safer for users.

        // Find all the input boxes for the quiz code
        const quizDigits = document.querySelectorAll('.quiz-digit');
        const hiddenQuizCode = document.getElementById('hidden_quiz_code');
        const quizForm = document.getElementById('quiz-form');

        quizDigits.forEach((digit, index) => {
            // Listen for input in each box
            digit.addEventListener('input', () => {
                // Only allow numbers (no letters or symbols)
                digit.value = digit.value.replace(/\D/g, '');

                // Move to the next box if this one is filled
                if (digit.value.length === 1 && index < quizDigits.length - 1) {
                    quizDigits[index + 1].focus();
                }

                // Combine all box values into the hidden input
                let code = '';
                quizDigits.forEach(input => {
                    code += input.value;
                });
                hiddenQuizCode.value = code;
            });

            // Handle backspace to move to the previous box
            digit.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && digit.value === '' && index > 0) {
                    quizDigits[index - 1].focus();
                }
            });
        });

        // Prevent form submission if all 4 digits aren't filled
        quizForm.addEventListener('submit', (e) => {
            let code = '';
            quizDigits.forEach(input => {
                code += input.value;
            });

            if (code.length !== 4 || !/^\d{4}$/.test(code)) {
                e.preventDefault(); // Stop form submission
                alert('Please enter a valid 4-digit quiz code.'); // Show a friendly message
            }
        });
    </script>
</body>

</html>
