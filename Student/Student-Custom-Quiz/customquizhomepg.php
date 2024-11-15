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
    <title>Custom Quiz</title>
    <link rel="stylesheet" href="customquizhomepg.css">
</head>
<body>
    <div class="container">
        <h1>Enter your Custom Quiz Code:</h1><br>
        <form method="post">
            <div class="code-input">
                    <input type="text" name="cqnum1" maxlength="1" oninput="moveToNext(this, 'box2')" id="box1" placeholder="0" onkeydown="handleBackspace(event, 'box1')" class="no-spinner">
                    <input type="text" name="cqnum2" maxlength="1" oninput="moveToNext(this, 'box3')" id="box2" placeholder="0" onkeydown="handleBackspace(event, 'box2')" class="no-spinner">
                    <input type="text" name="cqnum3" maxlength="1" oninput="moveToNext(this, 'box4')" id="box3" placeholder="0" onkeydown="handleBackspace(event, 'box3')" class="no-spinner">
                    <input type="text" name="cqnum4" maxlength="1" id="box4" placeholder="0" onkeydown="handleBackspace(event, 'box4')" class="no-spinner">
            </div><br>
            <button type="submit" name="cqenter" class="enterbutton">Enter</button>
        </form>
    </div>
    <script src="customquizhomepg.js"></script>
    <?php
        #Combine the 4 digits into a single code
        if (isset($_POST['cqenter'])){
            $cqnum1 = $_POST['cqnum1'];
            $cqnum2 = $_POST['cqnum2'];
            $cqnum3 = $_POST['cqnum3'];
            $cqnum4 = $_POST['cqnum4'];
            $cqcode = (int)($cqnum1 . $cqnum2 . $cqnum3 . $cqnum4);

            #Check if the code is in system
            $query = "SELECT * FROM custom_quiz WHERE quiz_code = ?";
            $stmt = $connect_db->prepare($query);
            $stmt->bind_param("i", $cqcode);
            $stmt->execute();
            $result = $stmt->get_result();

            #If yes, send $cqcode and pull up the next pg
            if ($result->num_rows > 0) {
                echo '<script>',
                    'window.location.href = "playcustomquiz.php";',
                    '</script>';
            }
            else {
                echo '<script>',
                    'alert("Invalid quiz code, please try again.");',
                    '</script>';
            }
        }
    ?>

</body>
</html>
