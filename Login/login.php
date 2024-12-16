<?php
// login.php

session_start();

// Include database connection
require_once '../Database/connection.php';

// Initialize variables
$errors = [];
$errMsg = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input
    $loginEmail = isset($_POST['LoginEmail']) ? trim($_POST['LoginEmail']) : '';
    $loginPassword = isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';

    // Validate inputs
    if (empty($loginEmail) || empty($loginPassword) || empty($role)) {
        echo '<script language="javascript">';
        echo '  alert("$Please enter you email, password, and select a role.")';
        echo '</script>';
    } else {
        // Determine the table based on role
        switch ($role) {
            case 'Student':
                $table = 'student';
                $id_field = 'student_id';
                $username_field = 'student_username';
                $email_field = 'student_email';
                $password_field = 'student_password';
                $dashboard = '../Student/userDashboard.php';
                break;
            case 'Educator':
                $table = 'educator';
                $id_field = 'educator_id';
                $username_field = 'educator_username';
                $email_field = 'educator_email';
                $password_field = 'educator_password';
                $dashboard = '../Educator/dashboard.php';
                break;
            case 'Admin':
                $table = 'admin';
                $id_field = 'admin_id';
                $username_field = 'admin_username';
                $email_field = 'admin_email';
                $password_field = 'admin_password';
                $dashboard = '../Admin/dashboard.php';
                break;
            default:
                $errMsg = "Invalid role selected.";
        }

        if (empty($errMsg)) {
            // Prepare the SQL statement to prevent SQL injection
            $stmt = $conn->prepare("SELECT `$id_field`, `$password_field`, `$username_field` FROM `$table` WHERE `$email_field` = ?");
            if ($stmt) {
                $stmt->bind_param("s", $loginEmail);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows === 1) {
                    $stmt->bind_result($user_id, $hashed_password, $username);
                    $stmt->fetch();

                    // Verify the password
                    if (password_verify($loginPassword, $hashed_password)) {
                        // Password is correct
                        // Regenerate session ID to prevent session fixation
                        session_regenerate_id(true);
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['username'] = $username;
                        $_SESSION['role'] = $role;

                        // Redirect to the respective dashboard
                        header("Location: $dashboard");
                        exit();
                    } else {
                        // Invalid password
                        $errMsg = "Invalid email or password.";
                    }
                } else {
                    // No user found with that email
                    $errMsg = "Invalid email or password.";
                }

                $stmt->close();
            } else {
                // SQL statement preparation failed
                error_log("Prepare failed: (" . $conn->errno . ") " . $conn->error);
                $errMsg = "Sorry, we're experiencing technical difficulties. Please try again later.";
            }
        }
    }

    // Store the error message in session and redirect back to login form
    $_SESSION['errMsg'] = $errMsg;
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RWDD Assignment Quiz</title>
    <link rel="stylesheet" href="login.css">
    <!-- Ionicons for Icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>

    <section>
        <form action="login.php" method="POST">
            <!-- Display Error Message -->
            <?php
            if (isset($_SESSION['errMsg'])) {
                echo '<div class="error-message">' . htmlspecialchars($_SESSION['errMsg']) . '</div>';
                unset($_SESSION['errMsg']);
            }
            ?>

            <h1>Login</h1>

            <!-- Role Selection -->
            <div class="radio-group">
                <input type="radio" id="student" name="role" value="Student" required>
                <label for="student">Student</label>

                <input type="radio" id="educator" name="role" value="Educator" required>
                <label for="educator">Educator</label>

                <input type="radio" id="admin" name="role" value="Admin" required>
                <label for="admin">Admin</label>
            </div>

            <!-- Email Input -->
            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" id="LoginEmail" name="LoginEmail" required placeholder=" ">
                <label for="LoginEmail">Email</label>
            </div>

            <!-- Password Input -->
            <div class="inputbox">
                <ion-icon name="eye-off-outline" id="togglePassword" style="cursor: pointer;"></ion-icon>
                <input type="password" id="LoginPassword" name="LoginPassword" required placeholder=" ">
                <label for="LoginPassword">Password</label>
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="forget">
                <label for="remember-me">
                    <input type="checkbox" id="remember-me" name="remember_me">Remember Me
                </label>
                <a href="forgot_password.php">Forgot Password?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn">Log in</button>

            <!-- Register Link -->
            <div class="register">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>

        </form>
    </section>

    <!-- Password Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const togglePassword = document.querySelector('#togglePassword');
            const passwordInput = document.querySelector('#LoginPassword');

            togglePassword.addEventListener('click', () => {
                // Toggle the type attribute
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Toggle the eye icon
                togglePassword.setAttribute('name', type === 'password' ? 'eye-off-outline' : 'eye-outline');
            });
        });
    </script>

</body>

</html>
