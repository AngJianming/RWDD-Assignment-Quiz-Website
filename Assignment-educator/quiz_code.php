<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Saved Popup</title>
    <link rel="stylesheet" href="quiz_code.css">
</head>
<body>

    <!-- Modal Container -->
    <div class="modal">
        <!-- Header Section -->
        <div class="congrats-icon">🎉 Congrats!</div>
        <div class="modal-header">Your quiz is saved!</div>

        <!-- Divider Line -->
        <div class="divider"></div>

        <!-- Info Text -->
        <div class="info-text">You published Quiz_Name<br>Want to share it with your students?</div>

        <!-- Share Links -->
        <div class="share-section">
            <div class="share-label">Share Link</div>
            <div class="share-item">
                <span class="share-text">www.1234.com</span>
                <img src="images/copyicon.png" style="width: 20px; height: auto;">
            </div>

            <div class="share-label">Share Code</div>
            <div class="share-item">
                <span class="share-text">01234</span>
                <img src="images/copyicon.png" style="width: 20px; height: auto;">
            </div>
        </div>

        <!-- Buttons Section -->
        <div class="buttons">
            <button class="add-quiz-button">Add Quiz</button>
            <button class="return-button">Return</button>
        </div>
    </div>

</body>
</html>
