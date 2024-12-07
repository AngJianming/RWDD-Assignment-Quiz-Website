<?php
    session_start();
    include("connection.php");
    include("combine-student.php");
    include("bganimation.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Custom Quiz Code</title>
    <link rel="stylesheet" href="playcustomquiz.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to XXX's Custom Quiz</h1><br>
        <h2>Please answer all questions. Click Start to begin. </h2><br>
        <form method="post">
            <button type="submit" name="startcq" class="enterbutton">Start</button>
        </form>
    </div>
    <script src="customquizhomepg.js"></script>
    <?php
        #play quiz
    ?>
</body>
</html>
