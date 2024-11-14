<?php
session_start();
session_destroy();
header('Location: /Constants/Sidebar-Student.php');
header('Location: /Constants/Sidebar-Admin.php');
header('Location: /Constants/Sidebar-Educator.php');
exit();
?>
