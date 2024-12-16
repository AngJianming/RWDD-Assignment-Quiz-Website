<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please login!');window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protected Page</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <header>
        <h1>Protected Page</h1>

        <!-- Link to logout page -->
        <a href="logout.php" class="logout-btn">Logout</a>
    </header>
    <main>
        <?php
        // User is logged in
        echo "<h1>Welcome to the protected page, <mark>" . $_SESSION['username'] . "</mark>!</h1>";
        ?>
    </main>

</body>

</html>