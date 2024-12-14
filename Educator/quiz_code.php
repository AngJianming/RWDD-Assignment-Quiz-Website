<?php
// Generate a random 4-digit code with leading zeros
$randomCode = sprintf('%04d', rand(0, 9999));

// Define the fixed base URL
$baseURL = 'https://www.example.com/quiz?code=';

// Construct the full share link
$shareLink = $baseURL . $randomCode;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Saved Popup</title>
    <?php include '../Constants/Bg-Animation.php'; ?>
    <link rel="stylesheet" href="quiz_code.css">
    <!-- Font Awesome for copy icons -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <style>
        /* Styling for the 'Copied!' message */
        .copied-message {
            display: none;
            margin-left: 8px;
            color: #555; /* Dark gray */
            font-size: 14px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .copied-message.show {
            display: inline;
            opacity: 1;
        }

        /* Styling for the copy icon animation */
        .copy-btn {
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
            position: relative;
        }

        .copy-btn.animate {
            transform: translateY(3px);
        }

        /* Ensure the share items are aligned */
        .share-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        /* Optional: Adjust spacing between text and icon */
        .share-text {
            word-break: break-all; /* Ensure long URLs break appropriately */
        }

        /* Optional: Add spacing between icon and 'Copied!' message */
        .copied-message {
            margin-left: 10px;
        }

        /* Optional: Hover effect */
        .copy-btn:hover {
            color: #f424ff; /* Change color on hover if desired */
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .share-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .copied-message {
                margin-left: 0;
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>

    <!-- Modal Container -->
    <div class="modal">
        <!-- Header Section -->
        <div class="congrats-icon">🎉 Congrats!</div>
        <div class="modal-header">Your Quiz is saved!</div>

        <!-- Divider Line -->
        <div class="divider"></div>

        <!-- Info Text -->
        <div class="info-text">You published a <strong>Quiz Name</strong><br>Want to share it with your students?</div>

        <!-- Share Links -->
        <div class="share-section">
            <div class="share-label">Share Link</div>
            <div class="share-item">
                <span class="share-text" id="shareLink"><?php echo htmlspecialchars($shareLink); ?></span>
                <i class="fa-solid fa-copy copy-btn" aria-label="Copy Link" data-clipboard-target="shareLink" title="Copy Link"></i>
                <span class="copied-message" id="copiedLink">Copied!</span>
            </div>

            <div class="share-label">Share Code</div>
            <div class="share-item">
                <span class="share-text" id="shareCode"><?php echo htmlspecialchars($randomCode); ?></span>
                <i class="fa-solid fa-copy copy-btn" aria-label="Copy Code" data-clipboard-target="shareCode" title="Copy Code"></i>
                <span class="copied-message" id="copiedCode">Copied!</span>
            </div>
        </div>

        <!-- Buttons Section -->
        <div class="buttons">
            <button class="add-quiz-button" onclick="location.href='add_quiz.php'">Add Quiz</button>
            <button class="return-button" onclick="location.href='return_page.php'">Return</button>
        </div>
    </div>

    <!-- JavaScript Section -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Function to copy text to clipboard
            function copyToClipboard(text) {
                if (navigator.clipboard && window.isSecureContext) {
                    // Navigator clipboard API method
                    return navigator.clipboard.writeText(text);
                } else {
                    // Fallback method using textarea
                    let textArea = document.createElement("textarea");
                    textArea.value = text;
                    // Make the textarea out of viewport
                    textArea.style.position = "fixed";
                    textArea.style.left = "-999999px";
                    textArea.style.top = "-999999px";
                    document.body.appendChild(textArea);
                    textArea.focus();
                    textArea.select();
                    return new Promise((res, rej) => {
                        // Execute the copy command
                        document.execCommand('copy') ? res() : rej();
                        textArea.remove();
                    });
                }
            }

            // Function to handle copy action
            function handleCopy(event) {
                const button = event.currentTarget;
                const targetId = button.getAttribute('data-clipboard-target');
                const textToCopy = document.getElementById(targetId).innerText;

                copyToClipboard(textToCopy)
                    .then(() => {
                        // Trigger animation
                        button.classList.add('animate');
                        setTimeout(() => {
                            button.classList.remove('animate');
                        }, 200); // Duration of the animation

                        // Show 'Copied!' message
                        const copiedMessageId = targetId === 'shareLink' ? 'copiedLink' : 'copiedCode';
                        const copiedMessage = document.getElementById(copiedMessageId);
                        copiedMessage.classList.add('show');

                        // Hide 'Copied!' message after 2 seconds
                        setTimeout(() => {
                            copiedMessage.classList.remove('show');
                        }, 2000);
                    })
                    .catch(() => {
                        alert('Failed to copy text.');
                    });
            }

            // Add event listeners to all copy buttons
            const copyButtons = document.querySelectorAll('.copy-btn');
            copyButtons.forEach(button => {
                button.addEventListener('click', handleCopy);
            });
        });
    </script>
</body>
</html>
