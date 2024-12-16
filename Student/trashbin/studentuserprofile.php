<?php
session_start();
include("Constants/Combine-student.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Student User Profile</title>
    <link rel="stylesheet" href="studentuserprofile.css">
</head>
<body class="dark-theme">

    <!-- If your included header/sidebar already outputs a header section, ensure no duplication -->
    <div class="profile-container">
        <div class="profile-header text-center">
            <div class="profile-pic-container">
                <img src="Image/userprofile.png" alt="User Profile" class="profile-pic"/>
            </div>
            <h1 class="profile-welcome">Welcome, XXX</h1>
        </div>

        <div class="profile-details">
            <div class="detail-row">
                <h2 class="detail-label">Username:</h2>
                <span class="detail-value">XXX</span>
            </div>
            <div class="detail-row">
                <h2 class="detail-label">Email:</h2>
                <span class="detail-value">XXX@example.com</span>
            </div>
            <div class="detail-row interactive-row">
                <h2 class="detail-label">Contact Number:</h2>
                <span class="detail-value">XXX</span>
                <button class="action-btn" aria-label="Edit Contact Number">&gt;</button>
            </div>
            <div class="detail-row interactive-row">
                <h2 class="detail-label">Change Password</h2>
                <button class="action-btn" aria-label="Change Password">&gt;</button>
            </div>
        </div>
    </div>

</body>
</html>
