<?php
session_start();
include("/xampp/htdocs/RWDD-Assignment-Quiz-Website/Constants/Combine-student.php");

// Sample data (replace with real data from your database)
$players = [
    ['name' => 'Triviaking99', 'score' => 4580],
    ['name' => 'PythonMaster', 'score' => 4320],
    ['name' => 'KnowItAll', 'score' => 4210],
    ['name' => 'QuizHero', 'score' => 4000],
    ['name' => 'Brainiac', 'score' => 3950],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Leaderboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../Student/student-css/Leaderboard.css">
</head>
<body>
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Leaderboard</h1>
            <p class="section-subtitle">Check out who’s currently dominating the quiz arena</p>
        </div>

        <div class="leaderboard">
            <div class="leaderboard-header">
                <h3>Player</h3>
                <h3>Score</h3>
            </div>
            <ul class="leaderboard-list">
                <?php foreach ($players as $index => $player): ?>
                <li>
                    <div class="leader-info">
                        <span class="rank"><?php echo $index + 1; ?></span>
                        <span class="player-name"><?php echo htmlspecialchars($player['name']); ?></span>
                    </div>
                    <span class="score"><?php echo htmlspecialchars($player['score']); ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="refresh-container">
            <button class="refresh-button" onclick="location.reload()">Refresh</button>
        </div>
    </div>
</body>
</html>
