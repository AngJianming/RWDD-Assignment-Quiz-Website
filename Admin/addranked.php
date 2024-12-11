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
    <!-- <?php //include '../Constants/Combine-admin.php'; ?> -->
    <?php include 'Combine-admin.php'; ?>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        /* Header */
        header {
            background-color: #221c36;
            color: white;
            position: relative;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
        }

        .logo {
            max-width: 6rem;
            max-height: 4rem;
            margin: 0 auto;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 1.5em;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        .search-signup {
            display: flex;
            align-items: center;
            gap: 0.5em;
        }

        .search-signup input {
            padding: 0.5em;
            border-radius: 4px;
            border: none;
        }

        .sign-in,
        .sign-up {
            padding: 0.5em 1em;
            border: none;
            border-radius: 4px;
        }

        .sign-in {
            background-color: #dadada;
            color: #333;
        }

        .sign-up {
            background-color: #6e30a8;
            color: white;
        }

        .sign-in:hover {
            background-color: #ffffff;
            color: #333;
        }

        .sign-up:hover {
            background-color: #a94dff;
            color: white;
        }

        img {
            width: 9rem;
            height: 3.0rem;
        }

        footer {
            background-color: #221c36;
            color: white;
            position: absolute;
            padding: 2em 0;
            bottom: 0;
            width: 100%;
        }

        .footer-container {
            display: flex;
            justify-content: space-around;
        }

        .footer-section h4 {
            color: #ff005c;
            margin-bottom: 1em;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li a {
            color: #ccc;
            text-decoration: none;
        }

        .footer-section ul li a:hover {
            color: white;
        }

        .social-icons a {
            color: #ccc;
            margin: 0 0.5em;
            text-decoration: none;
            font-size: 1.2em;
        }

        .social-icons a:hover {
            color: #ff005c;
        }
        
        .copyright {
            color: #f5f5f5;
            text-align: center;
            padding: 0px;
            margin-top: 0px;
            margin-bottom: -4px;
            font-size: 20px;
        }

        @media (max-width: 932px) {
            /* Collapse move lower by width */
            
        }

        /* Responsive Design */
        @media (max-width: 100px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            nav ul {
                flex-direction: column;
                gap: 0.5em;
                margin-top: 0.5em;
            }

            .search-signup {
                flex-direction: column;
                width: 100%;
                margin-top: 1em;
            }

            .search-signup input {
                width: 100%;
            }

            footer .footer-container {
                flex-direction: column;
                gap: 1em;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 0.5em;
            }

            .footer-container {
                padding: 1em;
                font-size: 0.9em;
            }

            .search-signup input {
                width: 100%;
                margin-bottom: 0.5em;
            }
        }
    </style>
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
                                <input type="text" class="option-text" placeholder="Enter option text here">
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
                                <input type="text" class="option-text" placeholder="Enter option text here">
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
                                <input type="text" class="option-text" placeholder="Enter option text here">
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
                                <input type="text" class="option-text" placeholder="Enter option text here">
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
                                <input type="text" class="option-text" placeholder="Enter option text here">
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
                                <input type="text" class="option-text" placeholder="Enter option text here">
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
                                <input type="text" class="option-text" placeholder="Enter option text here">
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
                                <input type="text" class="option-text" placeholder="Enter option text here">
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
                                <input type="text" class="option-text" placeholder="Enter option text here">
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
                                <input type="text" class="option-text" placeholder="Enter option text here">
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
        document.getElementById('return-btn').addEventListener('click', function() {
            event.preventDefault();
            const userConfirmed = confirm('Are you sure you want to return without saving the details?');
            if (userConfirmed) {
                window.location.href = 'rankedquiz.php';
            }
        });

        document.getElementById('save-btn').addEventListener('click', function(event) {
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