<?php
// addranked.php

// Start the session to handle flash messages
session_start();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected game mode
    $selectedMode = $_POST['game_mode'] ?? '';

    // TODO: Add your logic to publish the ranked game mode here
    // For example, save to database, validate input, etc.

    // For demonstration, we'll assume it's always successful
    $_SESSION['success'] = "You have successfully published the ranked game mode: " . htmlspecialchars($selectedMode) . "!";

    // Redirect to the same page to prevent form resubmission
    header("Location: addranked.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ranked Game Mode</title>
    <!-- Include your Combine-admin.php for constants or admin configurations -->
    <?php include 'Combine-admin.php'; ?>

    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Canvas Confetti Library -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <style>
        /* Additional styles specific to this page */

        .container {
            padding: 20px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 115px auto;
            width: 90%;
            max-width: 500px;
            background-color: #1e1e1e; /* Dark container background */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
        }

        h1 {
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            color: #e0e0e0;
            font-size: 16px;
        }

        select {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #444;
            background-color: #2c2c2c;
            color: #e0e0e0;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
            flex: 1;
            margin: 0 5px;
        }

        .btn.return {
            background-color: #555555;
            color: #ffffff;
        }

        .btn.return:hover {
            background-color: #777777;
            color: #ffffff;
        }

        .btn.save {
            background-color: #bb86fc;
            color: #000000;
        }

        .btn.save:hover {
            background-color: #9a67ea;
            color: #ffffff;
        }

        /* Success Message Styles */
        .success-container {
            padding: 20px;
            border-radius: 10px;
            background-color: #1e1e1e;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
            text-align: center;
            color: #e0e0e0;
            position: relative;
        }

        #green-tick-mark {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }

        /* Responsive Adjustments */
        @media (max-width: 600px) {
            .buttons {
                flex-direction: column;
            }

            .btn {
                margin: 5px 0;
            }
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="success-container">
            <img src="ImgIcon/green-check-mark-icon.png" id="green-tick-mark" alt="Success">
            <h1><?php echo $_SESSION['success']; ?></h1>
        </div>
        <?php
            // Clear the success message after displaying
            unset($_SESSION['success']);
        ?>
        <!-- Confetti Animation -->
        <script>
            // Function to trigger confetti
            function launchConfetti() {
                confetti({
                    particleCount: 100,
                    spread: 70,
                    origin: { y: 0.6 }
                });
            }

            // Launch confetti when the page loads
            window.onload = launchConfetti;
        </script>
    <?php else: ?>
        <div class="container">
            <h1>Add Ranked Game Mode</h1>
            <form method="POST" action="addranked.php">
                <div>
                    <label for="game_mode">Select Game Mode:</label>
                    <select name="game_mode" id="game_mode" required>
                        <option value="" disabled selected>-- Choose a Game Mode --</option>
                        <option value="Custom">Custom</option>
                        <option value="Ranked">Ranked</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="buttons">
                    <button type="button" class="btn return" onclick="window.history.back();">Return</button>
                    <button type="submit" class="btn save">Publish</button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</body>

</html>
