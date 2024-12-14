<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Library</title>
    <?php include '../Constants/Combine-educator.php' ?>
    <link rel="stylesheet" href="Mylibrary.css">
</head>
<body>
    <!-- Library Container -->
    <div class="library-container">
        <!-- Header Section -->
        <div class="library-header">My Library</div>

        <!-- Search Bar -->
        <div class="search-bar">
            <img src="images/searchicon.png" alt="Search Icon"> 
            <input type="text" placeholder="Search my library">
        </div>

        <!-- Quiz List Items -->
        <div class="quiz-item">
            <div class="quiz-info">
                <div class="quiz-title">Quiz_Name (15 Questions)</div>
                <div class="quiz-meta">Played 10 times<br>Created 30 minutes ago</div>
            </div>
            <button class="view-button">View</button>
        </div>

        <div class="quiz-item">
            <div class="quiz-info">
                <div class="quiz-title">Quiz_Name (30 Questions)</div>
                <div class="quiz-meta">Played 20 times<br>Created 2 hours ago</div>
            </div>
            <button class="view-button">View</button>
        </div>

        <div class="quiz-item">
            <div class="quiz-info">
                <div class="quiz-title">Quiz_Name (25 Questions)</div>
                <div class="quiz-meta">Played 40 times<br>Created 2 days ago</div>
            </div>
            <button class="view-button">View</button>
        </div>

        <div class="quiz-item">
            <div class="quiz-info">
                <div class="quiz-title">Quiz_Name (15 Questions)</div>
                <div class="quiz-meta">Played 60 times<br>Created 5 days ago</div>
            </div>
            <button class="view-button">View</button>
        </div>

        <!-- Additional View Button -->
        <div class="quiz-item">
            <div class="quiz-info">
                <div class="quiz-title">Quiz_Name (10 Questions)</div>
                <div class="quiz-meta">Played 5 times<br>Created 1 week ago</div>
            </div>
            <button class="view-button">View</button>
        </div>
    </div>
</body>
</html>
