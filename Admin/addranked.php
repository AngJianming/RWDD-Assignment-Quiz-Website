<?php
// Capture the 'level' parameter from the URL
$level = isset($_GET['level']) ? htmlspecialchars($_GET['level']) : 'Unknown Level';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ranked Levels</title>
    <link rel="stylesheet" href="addranked.css">
    <!-- <?php include '../Constants/Combine-admin.php'; ?> -->
    <?php include 'Combine-admin.php'; ?>
</head>

<body>
    <div class="class-container">
        <div class="quiz-container">
            <h1>Quiz in <?php echo $level ? $level : 'Unknown Level'; ?></h1>
            <form id="save-form" method="POST">
                <div class="question-box">
                    <div class="question">
                        <div class="question-number">Question 1</div>
                        <div class="question-text" contenteditable="true">Text</div>
                        <div class="answer-options">
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 1">
                                <input type="text" class="option-text"  placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 2">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 3">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 4">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                        </div>
                    </div>
                    <div class="question">
                        <div class="question-number">Question 2</div>
                        <div class="question-text" contenteditable="true">Text</div>
                        <div class="answer-options">
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 1">
                                <input type="text" class="option-text"  placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 2">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 3">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 4">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                        </div>
                    </div>
                    <div class="question">
                        <div class="question-number">Question 3</div>
                        <div class="question-text" contenteditable="true">Text</div>
                        <div class="answer-options">
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 1">
                                <input type="text" class="option-text"  placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 2">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 3">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 4">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                        </div>
                    </div>
                    <div class="question">
                        <div class="question-number">Question 4</div>
                        <div class="question-text" contenteditable="true">Text</div>
                        <div class="answer-options">
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 1">
                                <input type="text" class="option-text"  placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 2">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 3">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 4">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                        </div>
                    </div>
                    <div class="question">
                        <div class="question-number">Question 5</div>
                        <div class="question-text" contenteditable="true">Text</div>
                        <div class="answer-options">
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 1">
                                <input type="text" class="option-text"  placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 2">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 3">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 4">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                        </div>
                    </div>
                    <div class="question">
                        <div class="question-number">Question 6</div>
                        <div class="question-text" contenteditable="true">Text</div>
                        <div class="answer-options">
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 1">
                                <input type="text" class="option-text"  placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 2">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 3">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 4">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                        </div>
                    </div>
                    <div class="question">
                        <div class="question-number">Question 7</div>
                        <div class="question-text" contenteditable="true">Text</div>
                        <div class="answer-options">
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 1">
                                <input type="text" class="option-text"  placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 2">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 3">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 4">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                        </div>
                    </div>
                    <div class="question">
                        <div class="question-number">Question 8</div>
                        <div class="question-text" contenteditable="true">Text</div>
                        <div class="answer-options">
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 1">
                                <input type="text" class="option-text"  placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 2">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 3">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 4">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                        </div>
                    </div>
                    <div class="question">
                        <div class="question-number">Question 9</div>
                        <div class="question-text" contenteditable="true">Text</div>
                        <div class="answer-options">
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 1">
                                <input type="text" class="option-text"  placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 2">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 3">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 4">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                        </div>
                    </div>
                    <div class="question">
                        <div class="question-number">Question 10</div>
                        <div class="question-text" contenteditable="true">Text</div>
                        <div class="answer-options">
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 1">
                                <input type="text" class="option-text"  placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 2">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 3">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                            <div class="option">
                                <input type="radio" name="answer-option" value="Option 4">
                                <input type="text" class="option-text" placeholder="Enter option text here">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="buttons">
                    <button class="btn return" id="return-btn">Return</button>
                    <button class="btn save" id="save-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script>

        document.getElementById('return-btn').addEventListener('click', function () {
            event.preventDefault();
            const userConfirmed = confirm('Are you sure you want to return without saving the details?');
            if (userConfirmed) {
                window.location.href = 'rankedquiz.php';
            }
        });

        document.getElementById('save-btn').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the form's default submission behavior

        const userConfirmed = confirm('Are you sure you want to save the details?');
        if (userConfirmed) {
            const level = '<?php echo $level; ?>';
            window.location.href = 'editquizsuccessful.php?level=' + encodeURIComponent(level);
        }
    });

    </script>
</body>

</html>
<!-- <?php
if ($level) {
    header("Location: editquizsuccessful.php?level=" . urlencode($level));
    exit();
}
?> -->