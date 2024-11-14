<?php
session_start();
include("header.php");
include("footer.php");
include("sidebar.php");
// include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="sup2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student User Profile</title>
</head>
<body>
    <img src="Image/userprofile.png" width="150" height="150">
    <br>
    <h1>Welcome, XXX</h1> 
    <br><br><br>
    <div class="container">
        <h2>Username: </h2>
        <br><br>
        <h2>Email: XXX</h2>  
        <br><br>
        <h2>Contact Number: XXX
            <button style="background: none; border: none; font-size:20px; color: #333; cursor: pointer; margin-left: 250px" name="cqenter" class="button"><b>&gt;</b></button>
        </h2>
        <br><br>
        <h2>Change Password
            <button style="background: none; border: none; font-size: 20px; color: #333; cursor: pointer; margin-left: 290px" name="cqenter" class="button"><b>&gt;</b></button>
        </h2>
        </p>
</h2>
    </div>
</body>
</html>