<?php
// Start the session
session_start();

// Destroy the session
session_destroy();

echo "<script>alert('You have been logged out.');window.location.href='login.php';</script>";
?>
