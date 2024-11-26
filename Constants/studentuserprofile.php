<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your CSS files here -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student User Profile</title>
    <style>
        /* Reset margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #5c3d9a;
            margin: 0;
        }

        /* Header */
        header {
            background-color: #2d0d3f;
            color: white;
            width: 100%;
            z-index: 1000;
            position: relative; /* Changed from fixed to relative */
        }

        /* Footer */
        footer {
            background-color: #2d0d3f;
            color: white;
            width: 100%;
            z-index: 1000;
            position: relative; /* Changed from fixed to relative */
        }

        /* Wrapper for Sidebar and Content */
        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            transition: all 0.3s ease;
            background: #2d0d3f;
            color: white;
            overflow-y: auto;
            position: relative;
            z-index: 1100; /* Ensure the sidebar is above header and footer */
        }

        .sidebar.collapsed {
            width: 70px;
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            padding: 20px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 100;
        }

        /* Adjust main content margin when sidebar is collapsed */
        .wrapper .main-content {
            margin-left: 250px;
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: 70px;
        }

        /* Container styles */
        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            text-align: left;
            margin: 0 auto;
        }

        /* Adjust the content area to not be hidden under the header */
        .main-content {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        /* Adjust header and footer to stay at the top and bottom */
        header, footer {
            left: 0;
        }
    </style>
</head>
<body>
    <!-- Include Header -->
    <?php include("Constants/Header.php"); ?>

    <!-- Wrapper for Sidebar and Main Content -->
    <div class="wrapper">
        <!-- Include Sidebar -->
        <?php include("Constants/Sidebar-Student.php"); ?>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Your content goes here -->
            <img src="Image/userprofile.png" width="150" height="150">
            <h1>Welcome, XXX</h1>
            <div class="container">
                <h2>Username: </h2>
                <h2>Email: XXX</h2>
                <h2>Contact Number: XXX
                    <button style="background: none; border: none; font-size:20px; color: #333; cursor: pointer; margin-left: 250px" name="cqenter" class="button"><b>&gt;</b></button>
                </h2>
                <h2>Change Password
                    <button style="background: none; border: none; font-size: 20px; color: #333; cursor: pointer; margin-left: 290px" name="cqenter" class="button"><b>&gt;</b></button>
                </h2>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include("Constants/Footer.php"); ?>

    <!-- Include JavaScript -->
    <script>
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        });
    </script>
</body>
</html>
