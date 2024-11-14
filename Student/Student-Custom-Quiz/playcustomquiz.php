<?php
    session_start();
    include("connection.php");
    include("header.php");
    include("footer.php");
    include("sidebar.php");
    include("bganimation.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Custom Quiz Code</title>
    <link rel="stylesheet" href="customquizhomepg.css">
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
        if (isset($_POST['cqenter'])){
            $cqnum1 = $_POST['cqnum1'];
            $cqnum2 = $_POST['cqnum2'];
            $cqnum3 = $_POST['cqnum3'];
            $cqnum4 = $_POST['cqnum4'];
            $cqcode = (int)($cqnum1 . $cqnum2 . $cqnum3 . $cqnum4);
            #Check if the code is in system
            #If yes, send $cqcode and pull up the next pg`
        }
    ?>

</body>
</html>
