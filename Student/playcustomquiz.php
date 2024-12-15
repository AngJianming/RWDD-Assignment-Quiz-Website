<?php
// playCustomQuiz.php
/* 
// Start the session
session_start();
*/
// Include the Combine-student.php partial
include '../Constants/Combine-student.php';
/*
// Include the database connection
include '../Constants/conn.php';

// Initialize variables
$quiz_code = "";
$error = "";
*/
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the quiz code
    $quiz_code_input = trim($_POST['quiz_code'] ?? '');

    // Validate the quiz code
    if (empty($quiz_code_input)) {
        $error = "Please enter a 4-digit quiz code.";
    } elseif (!preg_match('/^\d{4}$/', $quiz_code_input)) {
        $error = "Quiz code must be exactly 4 digits.";
    } else {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT quiz_id, quiz_name FROM custom_quiz WHERE quiz_code = ?");
        $stmt->bind_param("i", $quiz_code_input);
        $stmt->execute();
        $stmt->bind_result($quiz_id, $quiz_name);

        if ($stmt->fetch()) {
            // Quiz code is valid, redirect to the quiz page
            // Pass the quiz_id via GET parameter
            header("Location: takeQuiz.php?quiz_id=" . urlencode($quiz_id));
            exit();
        } else {
            // Invalid quiz code
            $error = "Invalid quiz code. Please try again.";
        }

        $stmt->close();
    }

    // Close the connection
    $conn->close();
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
                <form action="playCustomQuiz.php" method="POST" class="quiz-form" id="quiz-form">
                    <div class="form-group">
                        <label for="quiz_code">Enter Custom Quiz Code</label>
                        <div class="quiz-code-inputs">
                            <input type="text" class="quiz-digit" maxlength="1" pattern="\d" required autocomplete="off" inputmode="numeric" />
                            <input type="text" class="quiz-digit" maxlength="1" pattern="\d" required autocomplete="off" inputmode="numeric" />
                            <input type="text" class="quiz-digit" maxlength="1" pattern="\d" required autocomplete="off" inputmode="numeric" />
                            <input type="text" class="quiz-digit" maxlength="1" pattern="\d" required autocomplete="off" inputmode="numeric" />
                        </div>
                        <?php if (!empty($error)): ?>
                            <span class="error"><?php echo htmlspecialchars($error); ?></span>
                        <?php endif; ?>
                        <!-- Hidden input to hold the concatenated quiz code -->
                        <input type="hidden" name="quiz_code" id="hidden_quiz_code" value="<?php echo htmlspecialchars($quiz_code); ?>">
                    </div>
                    <button type="submit" class="btn">Join Quiz</button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Sidebar Toggle (if not already included in Combine-student.php) -->
    <script>
        const btn = document.querySelector("#btn");
        const sidebar = document.querySelector(".sidebar");
        const overlay = document.querySelector(".overlay");

        // Toggle sidebar and overlay on button click
        btn.addEventListener('click', function(event) {
            sidebar.classList.toggle("active");
            overlay.classList.toggle("active");
            // Prevent the click from propagating to the document
            event.stopPropagation();
        });

        // Prevent clicks inside the sidebar from closing it
        sidebar.addEventListener('click', function(event) {
            event.stopPropagation();
        });

        // Close sidebar and overlay when clicking on the overlay
        overlay.addEventListener('click', function() {
            sidebar.classList.remove("active");
            overlay.classList.remove("active");
        });

        // JavaScript for handling quiz code input
        document.addEventListener('DOMContentLoaded', () => {
            const quizDigits = document.querySelectorAll('.quiz-digit');
            const hiddenQuizCode = document.getElementById('hidden_quiz_code');
            const quizForm = document.getElementById('quiz-form');

            quizDigits.forEach((digit, index) => {
                digit.addEventListener('input', () => {
                    // Remove any non-digit characters
                    digit.value = digit.value.replace(/\D/g, '');

                    if (digit.value.length === 1 && index < quizDigits.length - 1) {
                        // Move focus to the next input
                        quizDigits[index + 1].focus();
                    }

                    // Concatenate all digits to the hidden input
                    let code = '';
                    quizDigits.forEach(input => {
                        code += input.value;
                    });
                    hiddenQuizCode.value = code;
                });

                digit.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && digit.value === '' && index > 0) {
                        // Move focus to the previous input
                        quizDigits[index - 1].focus();
                    }
                });
            });

            // Optional: Prevent form submission if not all digits are entered
            quizForm.addEventListener('submit', (e) => {
                let code = '';
                quizDigits.forEach(input => {
                    code += input.value;
                });
                if (code.length !== 4) {
                    e.preventDefault();
                    alert('Please enter a valid 4-digit quiz code.');
                }
            });
        });
    </script>
</body>

</html>