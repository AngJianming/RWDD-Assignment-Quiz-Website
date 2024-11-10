<?php
include("header.php");
include("hamburgermenu.php");
include("footer.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Custom Quiz Code</title>
    <link rel="stylesheet" href="cqhomepage.css">
</head>
<body>
    <div class="container">
        <h1>Enter your Custom Quiz Code:</h1>
        <form id="quizForm" action="submit_code.php" method="POST">
            <div class="code-inputs">
                <input type="text" maxlength="1" class="code" name="code[]" required>
                <input type="text" maxlength="1" class="code" name="code[]" required>
                <input type="text" maxlength="1" class="code" name="code[]" required>
                <input type="text" maxlength="1" class="code" name="code[]" required>
            </div>
            <button type="submit" class="enter-btn">Enter</button>
        </form>
    </div>
    <script src="testing.js"></script>
    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect the code entered by the user
    $code = implode('', $_POST['code']);

    // Process the code here (validate, check in DB, etc.)
    echo "You entered the code: $code";
}
?>

</body>
</html>
