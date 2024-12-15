<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Combat Dashboard</title>
    <?php include '../Constants/Combine-student.php' ?>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <link rel="stylesheet" href="../Student/student-css/userDashboard.css">
</head>
<body class="main-body">
    <div class="dashboard">
        <div class="content-header">
            <div class="dashlogo">RWDD Group 10</div>
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="profile">
                <span>Welcome back, <strong>User</strong></span>
                <div class="avatar">👤</div>
            </div>
        </div>
        <main>
            <section class="overview">
                <div class="block popular-quiz">
                    <h2>Popular Custom Quiz</h2>
                    <div class="quiz-card">
                        <h3>Python Basics</h3>
                        <p>Master the fundamentals of Python.</p>
                        <button>Start Quiz</button>
                    </div>
                </div>
                <div class="block statistics">
                    <h2>Your Statistics</h2>
                    <div class="stat">
                        <h3>Completed Ranked Quizzes</h3>
                        <p>3</p>
                    </div>
                    <div class="stat">
                        <h3>Custom Quizzes Participated</h3>
                        <p>10</p>
                    </div>
                </div>
            </section>
            <section class="new-quizzes">
                <h2>New Ranked Quizzes</h2>
                <div class="quiz-list">
                    <div class="quiz-item">
                        <h3>Level 4 Advanced Supahigh</h3>
                        <p>Challenge yourself with Python advanced data stuctures.</p>
                        <img class="rankimg" src="https://4kwallpapers.com/images/wallpapers/python-logo-purple-2560x1440-16084.jpg" alt="Image of Level 4 Ranked Quiz">
                        <button class="rankbtn">Start Quiz</button>
                    </div>
                    <div class="quiz-item">
                        <h3>Level 5 Demi-god Python</h3>
                        <p>Learn Python AI Algorithms.</p>
                        <img class="rankimg" src="https://4kwallpapers.com/images/walls/thumbs_2t/16015.jpg" alt="Image of Level 5 Ranked Quiz">
                        <button class="rankbtn">Start Quiz</button>
                    </div>
                </div>
                <div class="quiz-list">
                    <div class="quiz-item">
                        <h3>Level ???</h3>
                        <p>Comming Soon...</p>
                        <img class="rankimg" src="https://external-preview.redd.it/nKGUdth3FuTDHyOAiDmRjlyPzNMJKgjQlQ9H0sxS6_Y.jpg?auto=webp&s=50119ba8e3ba2986974cc9a14019959dfae8d6a4" alt="Image of Level 4 Ranked Quiz">
                        <button class="ranklock">Locked</button>
                    </div>
                    <div class="quiz-item">
                        <h3>Level ???</h3>
                        <p>Comming Soon...</p>
                        <img class="rankimg" src="https://external-preview.redd.it/nKGUdth3FuTDHyOAiDmRjlyPzNMJKgjQlQ9H0sxS6_Y.jpg?auto=webp&s=50119ba8e3ba2986974cc9a14019959dfae8d6a4" alt="Image of Level 5 Ranked Quiz">
                        <button class="ranklock">Locked</button>
                    </div>
                </div>
                <div class="quiz-list">
                    <div class="quiz-item">
                        <h3>Level ???</h3>
                        <p>Comming Soon...</p>
                        <img class="rankimg" src="https://external-preview.redd.it/nKGUdth3FuTDHyOAiDmRjlyPzNMJKgjQlQ9H0sxS6_Y.jpg?auto=webp&s=50119ba8e3ba2986974cc9a14019959dfae8d6a4" alt="Image of Level 4 Ranked Quiz">
                        <button class="ranklock">Locked</button>
                    </div>
                    <div class="quiz-item">
                        <h3>Level ???</h3>
                        <p>Comming Soon...</p>
                        <img class="rankimg" src="https://external-preview.redd.it/nKGUdth3FuTDHyOAiDmRjlyPzNMJKgjQlQ9H0sxS6_Y.jpg?auto=webp&s=50119ba8e3ba2986974cc9a14019959dfae8d6a4" alt="Image of Level 5 Ranked Quiz">
                        <button class="ranklock">Locked</button>
                    </div>
                </div>
                <div class="quiz-list">
                    <div class="quiz-item">
                        <h3>Level ???</h3>
                        <p>Comming Soon...</p>
                        <img class="rankimg" src="https://external-preview.redd.it/nKGUdth3FuTDHyOAiDmRjlyPzNMJKgjQlQ9H0sxS6_Y.jpg?auto=webp&s=50119ba8e3ba2986974cc9a14019959dfae8d6a4" alt="Image of Level 4 Ranked Quiz">
                        <button class="ranklock">Locked</button>
                    </div>
                    <div class="quiz-item">
                        <h3>Level ???</h3>
                        <p>Comming Soon...</p>
                        <img class="rankimg" src="https://external-preview.redd.it/nKGUdth3FuTDHyOAiDmRjlyPzNMJKgjQlQ9H0sxS6_Y.jpg?auto=webp&s=50119ba8e3ba2986974cc9a14019959dfae8d6a4" alt="Image of Level 5 Ranked Quiz">
                        <button class="ranklock">Locked</button>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
