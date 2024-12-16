<?php
// Enable error reporting for debugging (Remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session if you need to track student sessions
// session_start();

include ('../../Database/connection.php');

// Retrieve submitted answers
$userAnswers = isset($_POST['answers']) ? $_POST['answers'] : [];
$score = 0;
$totalQuestions = count($userAnswers);

// Fetch correct answers from the database
if ($totalQuestions > 0) {
    // Prepare an array of question IDs to prevent SQL injection
    $questionIds = array_keys($userAnswers);
    $placeholders = implode(',', array_fill(0, count($questionIds), '?'));

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT question_id, correct_option FROM questions WHERE question_id IN ($placeholders)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters dynamically
    $types = str_repeat('s', count($questionIds)); // Assuming question_id is VARCHAR
    $stmt->bind_param($types, ...$questionIds);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    $correctAnswers = [];
    while ($row = $result->fetch_assoc()) {
        $correctAnswers[$row['question_id']] = $row['correct_option'];
    }

    // Close the statement
    $stmt->close();

    // Calculate the score
    foreach ($userAnswers as $qid => $selected_option) {
        if (isset($correctAnswers[$qid]) && strtoupper($selected_option) === strtoupper($correctAnswers[$qid])) {
            $score++;
        }
    }

        // Optional: Record the quiz submission
        // Assuming you have a logged-in student and their ID is stored in session
        /*
    if (isset($_SESSION['student_id'])) {
        $student_id = $_SESSION['student_id'];
        $time_taken = /* Calculate time taken */;
    // Insert into quiz_submission table
    $stmt = $conn->prepare("INSERT INTO quiz_submission (student_id, time_taken) VALUES (?, ?)");
    $stmt->bind_param("ii", $student_id, $time_taken);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Congratulations!</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Montserrat', sans-serif;
      background: #000; /* Black background */
      color: #fff; 
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      padding: 0 20px;
      box-sizing: border-box;
    }

    .flex-center {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    #end {
      max-width: 400px;
      width: 100%;
      padding: 40px;
      border: 1px solid #3c1e63; /* Purple border */
      border-radius: 8px;
      background: #111; /* Slightly lighter black */
      box-shadow: 0 0 10px rgba(0,0,0,0.5);
    }

    #end h1 {
      margin: 0;
      font-size: 2.5rem;
      margin-bottom: 20px;
      color: #caa0f5; /* Light purple for headings */
    }

    p {
      font-size: 1.1rem;
      line-height: 1.5;
      color: #ccc; 
      margin-bottom: 20px;
    }

    .btn {
      display: inline-block;
      text-decoration: none;
      text-align: center;
      padding: 10px 20px;
      border: 1px solid #3c1e63;
      border-radius: 4px;
      background: #3c1e63; /* Purple background */
      color: #fff;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s ease;
      margin: 5px 0;
    }

    .btn:hover {
      background: #5f2d9f; /* Slightly lighter purple on hover */
    }

    a.btn {
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <div id="end" class="flex-center flex-column">
      <h1 id="finalScore"></h1>
      <p>Would you like to save this result to your history records?</p>
      <button class="btn" id="saveScoreBtn" onclick="saveHighScore(event)">Save</button>
      <a class="btn" href="../game functions/game.php">Play Again</a>
      <a class="btn" href="../Play.php">Home</a>
    </div>
  </div>

  <script src="end.js"></script>
</body>
</html>
