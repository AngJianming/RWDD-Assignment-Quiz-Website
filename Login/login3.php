<?php
// login.php

session_start();

// Include database connection
require_once '../Database/connection.php';

// Initialize variables
$errors = [];
$success = '';

// Check if user is already logged in via session
if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    // Redirect to respective dashboard
    switch ($_SESSION['role']) {
        case 'Student':
            header("Location: ../Student/userDashboard.php");
            break;
        case 'Educator':
            header("Location: ../Educator/dashboard.php");
            break;
        case 'Admin':
            header("Location: ../Admin/dashboard.php");
            break;
    }
    exit();
}

// Check for "Remember Me" cookie
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
    $remember_token = $_COOKIE['remember_me'];

    // Search for the token in all role tables
    $tables = ['student', 'educator', 'admin'];
    foreach ($tables as $table) {
        $id_field = $table . '_id';
        $username_field = $table . '_username';
        $email_field = $table . '_email';
        $password_field = $table . '_password';
        $remember_field = 'remember_token';

        $stmt = $conn->prepare("SELECT `$id_field`, `$username_field`, `role` FROM `$table` WHERE `$remember_field` = ?");
        if ($stmt) {
            $stmt->bind_param("s", $remember_token);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 1) {
                $stmt->bind_result($user_id, $username, $role);
                $stmt->fetch();

                // Log the user in
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                // Regenerate session ID
                session_regenerate_id(true);

                // Redirect to respective dashboard
                switch ($role) {
                    case 'Student':
                        header("Location: ../Student/userDashboard.php");
                        break;
                    case 'Educator':
                        header("Location: ../Educator/dashboard.php");
                        break;
                    case 'Admin':
                        header("Location: ../Admin/dashboard.php");
                        break;
                }
                exit();
            }
            $stmt->close();
        }
    }

    // If token is invalid, delete the cookie
    setcookie("remember_me", "", time() - 3600, "/", "", true, true);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $loginEmail = isset($_POST['LoginEmail']) ? trim($_POST['LoginEmail']) : '';
    $loginPassword = isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';
    $remember_me = isset($_POST['remember_me']) ? 1 : 0;

    // Validate inputs
    if (empty($loginEmail) || empty($loginPassword) || empty($role)) {
        $errors[] = "Please enter your email, password, and select a role.";
    } else {
        // Determine the table based on role
        switch ($role) {
            case 'Student':
                $table = 'student';
                $id_field = 'student_id';
                $username_field = 'student_username';
                $email_field = 'student_email';
                $password_field = 'student_password';
                break;
            case 'Educator':
                $table = 'educator';
                $id_field = 'educator_id';
                $username_field = 'educator_username';
                $email_field = 'educator_email';
                $password_field = 'educator_password';
                break;
            case 'Admin':
                $table = 'admin';
                $id_field = 'admin_id';
                $username_field = 'admin_username';
                $email_field = 'admin_email';
                $password_field = 'admin_password';
                break;
            default:
                $errors[] = "Invalid role selected.";
        }

        if (empty($errors)) {
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

                        // Handle "Remember Me" functionality
                        if ($remember_me) {
                            // Generate a unique token
                            $remember_token = bin2hex(random_bytes(16));

                            // Store the token in the database
                            $update_stmt = $conn->prepare("UPDATE `$table` SET `remember_token` = ? WHERE `$id_field` = ?");
                            if ($update_stmt) {
                                $update_stmt->bind_param("si", $remember_token, $user_id);
                                $update_stmt->execute();
                                $update_stmt->close();

                                // Set the cookie (valid for 30 days)
                                setcookie("remember_me", $remember_token, time() + (30 * 24 * 60 * 60), "/", "", true, true);
                            }
                        } else {
                            // If "Remember Me" is not checked, ensure the token is cleared
                            $update_stmt = $conn->prepare("UPDATE `$table` SET `remember_token` = NULL WHERE `$id_field` = ?");
                            if ($update_stmt) {
                                $update_stmt->bind_param("i", $user_id);
                                $update_stmt->execute();
                                $update_stmt->close();

                                // Delete the cookie if it exists
                                if (isset($_COOKIE['remember_me'])) {
                                    setcookie("remember_me", "", time() - 3600, "/", "", true, true);
                                }
                            }
                        }

                        // Redirect to respective dashboard
                        switch ($role) {
                            case 'Student':
                                header("Location: ../Student/userDashboard.php");
                                break;
                            case 'Educator':
                                header("Location: ../Educator/dashboard.php");
                                break;
                            case 'Admin':
                                header("Location: ../Admin/dashboard.php");
                                break;
                        }
                        exit();
                    } else {
                        // Invalid password
                        $errors[] = "Invalid email or password.";
                    }
                } else {
                    // No user found with that email
                    $errors[] = "Invalid email or password.";
                }

                $stmt->close();
            } else {
                $errors[] = "Database error: Unable to prepare statement.";
            }
        }
    }

    // Store the error messages in session and redirect back to login form
    $_SESSION['errMsg'] = $errors;
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
            <!-- Display Error Messages -->
            <?php
            if (isset($_SESSION['errMsg']) && !empty($_SESSION['errMsg'])) {
                echo '<div class="error-message">';
                foreach ($_SESSION['errMsg'] as $error) {
                    echo htmlspecialchars($error) . "<br>";
                }
                echo '</div>';
                unset($_SESSION['errMsg']);
            }

            if (isset($_SESSION['success_message'])) {
                echo '<div class="success-message">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
                unset($_SESSION['success_message']);
            }
            ?>

            <h1>Login</h1>

            <!-- Role Selection -->
            <div class="radio-group">
                <input type="radio" id="student" name="role" value="Student" <?php if (isset($_POST['role']) && $_POST['role'] === 'Student') echo 'checked'; ?> required>
                <label for="student">Student</label>

                <input type="radio" id="educator" name="role" value="Educator" <?php if (isset($_POST['role']) && $_POST['role'] === 'Educator') echo 'checked'; ?> required>
                <label for="educator">Educator</label>

                <input type="radio" id="admin" name="role" value="Admin" <?php if (isset($_POST['role']) && $_POST['role'] === 'Admin') echo 'checked'; ?> required>
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
                <ion-icon name="eye-off-outline" id="togglePassword"></ion-icon>
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
