<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

echo "Welcome, " . $_SESSION['name'];
echo "<br>Your email: " . $_SESSION['email'];
echo "<br><a href='logout.php'>Logout</a>";
?>
