<?php
// logout.php

// **1. Start the Session**
// This ensures that the script has access to the session data.
session_start();

// **2. Unset All Session Variables**
// This removes all session variables currently registered.
$_SESSION = array();

// **3. Delete the Session Cookie**
// This ensures that the session is completely destroyed.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// **4. Destroy the Session**
// This removes the session data from the server.
session_destroy();

// **5. Redirect the User**
// Change 'login.php' to the desired page you want users to see after logout.
header("Location: login.php");
exit;
?>
