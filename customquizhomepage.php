<?php
session_start();
// include("header.php");
include("hamburgermenu.php");
#include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="customquizhomepg.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quiz Home Page</title>
</head>
<body>
    <div class="container">
        <p>Enter your Custom Quiz Code:</p>
        <form method="post">
            <div class="code-input">
                    <input type="text" name="cqnum1" maxlength="1" oninput="moveToNext(this, 'box2')" id="box1" placeholder="0" onkeydown="handleBackspace(event, 'box1')" class="no-spinner">
                    <input type="text" name="cqnum2" maxlength="1" oninput="moveToNext(this, 'box3')" id="box2" placeholder="0" onkeydown="handleBackspace(event, 'box2')" class="no-spinner">
                    <input type="text" name="cqnum3" maxlength="1" oninput="moveToNext(this, 'box4')" id="box3" placeholder="0" onkeydown="handleBackspace(event, 'box3')" class="no-spinner">
                    <input type="text" name="cqnum4" maxlength="1" id="box4" placeholder="0" onkeydown="handleBackspace(event, 'box4')" class="no-spinner">
            </div>
            <button type="submit" name="cqenter" class="enterbutton">Enter</button>
        </form>
    </div>


    <script>
    function moveToNext(currentInput, nextBoxId) {
        // Allow only numbers
        currentInput.value = currentInput.value.replace(/[^0-9]/g, '');
        
        // Check if the current input has a value
        if (currentInput.value.length === 1) {
            // Move focus to the next input box
            const nextInput = document.getElementById(nextBoxId);
            if (nextInput) {
                nextInput.focus();
            }
        }
    }

    function handleBackspace(event, currentBoxId) {
        if (event.key === 'Backspace') {
            const currentInput = document.getElementById(currentBoxId);
            // If the current input is empty, remove it and focus the previous box
            if (currentInput.value === '') {
                // Move focus to the previous input box
                const previousBoxId = currentInput.previousElementSibling ? currentInput.previousElementSibling.id : null;
                if (previousBoxId) {
                    const previousInput = document.getElementById(previousBoxId);
                    previousInput.value = ''; // Clear the value in the previous box
                    previousInput.focus(); // Move focus to the previous box
                }
            }
        }
    }
    </script>

    <?php
        if (isset($_POST['cqenter'])){
            $cqnum1 = $_POST['cqnum1'];
            $cqnum2 = $_POST['cqnum2'];
            $cqnum3 = $_POST['cqnum3'];
            $cqnum4 = $_POST['cqnum4'];
            $cqcode = (int)($cqnum1 . $cqnum2 . $cqnum3 . $cqnum4);
            #Check if the code is in system
            #If yes, send $cqcode and pull up the next pg
        }
    ?>

</body>
</html>
