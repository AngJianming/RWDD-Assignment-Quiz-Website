<?php
// Admin/rankedquiz.php

session_start();

// Include admin environment file if needed
include '../Constants/Combine-admin.php';

// Include DB connection
require '../Database/connection.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}

// Fetch all quiz levels from the database
$sql_levels = "SELECT * FROM ranked_quiz_levels ORDER BY ranked_quiz_id ASC";
$result_levels = $conn->query($sql_levels);

$levels = [];
if ($result_levels && $result_levels->num_rows > 0) {
    while ($row = $result_levels->fetch_assoc()) {
        $levels[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Ranked Quizzes</title>
    <link rel="stylesheet" href="rankedquiz.css">
    <link rel="stylesheet" href="../css/admin_styles.css"> <!-- Assuming you have a global admin stylesheet -->
</head>
<body>
    <div class="container">
        <h1 class="page-title">Manage Ranked Quizzes</h1>
        <div class="content">
            <div class="levels" id="levels-container">
                <!-- Existing levels will be loaded here -->
                <?php foreach ($levels as $level): ?>
                    <div class="level-card <?php echo $level['is_published'] ? 'published' : ''; ?>">
                        <h2><?php echo htmlspecialchars($level['ranked_quiz_level']); ?></h2>
                        <p><?php echo htmlspecialchars($level['ranked_quiz_name']); ?></p>
                        <p>Duration: <?php echo htmlspecialchars($level['ranked_quiz_duration']); ?> mins</p>
                        <p>Total Score: <?php echo htmlspecialchars($level['ranked_score']); ?></p>
                        <p>Status: <?php echo $level['is_published'] ? 'Published' : 'Unpublished'; ?></p>
                        <div class="actions">
                            <a href="addranked.php?edit=<?php echo $level['ranked_quiz_id']; ?>" class="btn edit-btn">Edit</a>
                            <a href="delete_level.php?id=<?php echo $level['ranked_quiz_id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this quiz level? This will also delete all associated questions.')">Delete</a>
                            <?php if (!$level['is_published']): ?>
                                <a href="publish_level.php?id=<?php echo $level['ranked_quiz_id']; ?>" class="btn publish-btn" onclick="return confirm('Are you sure you want to publish this quiz level? It will be available to students.')">Publish</a>
                            <?php else: ?>
                                <span class="published-label">Published</span>
                            <?php endif; ?>
                            <a href="manage_questions.php?id=<?php echo $level['ranked_quiz_id']; ?>" class="btn manage-questions-btn">Manage Questions</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($levels)): ?>
                    <p>No quiz levels found. Please add a new quiz level.</p>
                <?php endif; ?>
            </div>
            <div class="actions">
                <a href="addranked.php" class="btn add-level-btn">Add New Level</a>
            </div>
        </div>
    </div>
</body>
</html>
