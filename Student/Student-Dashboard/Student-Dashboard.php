<?php
session_start();
include("Constants/Header.php");
include("Constants/Footer.php");
include("Constants/Sidebar-Student.php");
// include("connection.php");
?>

<!DOCTYPE html>
<html lang="en" dir="US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="Student-Dashboard.css">

    <!-- Fluent UI CDN Link -->
    <link rel="stylesheet" href="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-core/11.0.0/css/fabric.min.css">
</head>

<body class="ms-Fabric">

    <!-- Main Page content will be here, don't mix with side-bar stuff -->
    <div class="home_content">

        <!-- Content home principal page -->
        <div class="wrapper">

            <!-- Header -->
            <header class="header">
                <?php include ("/Constants/Footer.php"); ?>
            </header>

            <!-- Main content -->
            <div class="content image-section">
                <p>Image</p>
            </div>

            <div class="content play-section">
                <p>Contents</p>
                <a href="">
                    <button class="play-button">Play</button>
                </a>
            </div>

            <!-- VV Footer VV -->
            <footer>
                <?php include ("/Constants/Footer.php"); ?>
            </footer>

        </div>

        <div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
        </div>

    </div>
    <script src="/Student/Student-Dashboard/Student-Dashboard.js"></script>
</body>

</html>
<!-- 
<!DOCTYPE html>
<html>
<head>
<style>
div {
  border: 1px solid gray;
  padding: 8px;
}

h1 {
  text-align: center;
  text-transform: uppercase;
  color: #4CAF50;
}

p {
  text-indent: 50px;
  text-align: justify;
  letter-spacing: 3px;
}

a {
  text-decoration: none;
  color: #008CBA;
}
</style>
</head>
<body>

<div>
  <h1>text formatting</h1>
  <p>This text is styled with some of the text formatting properties. The heading uses the text-align, text-transform, and color properties.
  The paragraph is indented, aligned, and the space between characters is specified. The underline is removed from this colored
  <a target="_blank" href="tryit.asp?filename=trycss_text">"Try it Yourself"</a> link.</p>
</div>

</body>
</html> -->