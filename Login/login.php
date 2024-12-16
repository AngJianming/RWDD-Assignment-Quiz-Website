<?php
// REMOVE LATER: Clear existing session
session_start();
session_unset();
session_destroy();

// Start a new session
session_start();

// Include database connection
require_once '../Database/connection.php';

// Initialize variables
$errors = [];
$success = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $loginEmail = isset($_POST['LoginEmail']) ? trim($_POST['LoginEmail']) : '';
    $loginPassword = isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';

    // Validate inputs
    if (empty($loginEmail) || empty($loginPassword) || empty($role)) {
        $errors[] = "Please enter your email, password, and select a role.";
    } else {
        // Determine the table and fields based on the role
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
                    $stmt->bind_result($user_id, $stored_password, $username);
                    $stmt->fetch();

                    // Directly compare the passwords (no hashing)
                    if ($loginPassword === $stored_password) {
                        // Password is correct
                        session_regenerate_id(true);
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['username'] = $username;
                        $_SESSION['role'] = $role;

                        // Redirect to respective dashboard
                        switch ($role) {
                            case 'Student':
                                header("Location: ../Student/userDashboard.php");
                                exit();
                            case 'Educator':
                                header("Location: ../Educator/dashboard.php");
                                exit();
                            case 'Admin':
                                header("Location: ../Admin/dashboard.php");
                                exit();
                        }
                    } else {
                        // Invalid password
                        $errors[] = 'Invalid password.';
                    }
                } else {
                    // No user found with that email
                    $errors[] = 'Invalid email.';
                }

                $stmt->close();
            } else {
                $errors[] = "Database error: Unable to prepare statement.";
            }
        }
    }
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
            if (!empty($errors)) {
                echo '<div class="error-message">';
                foreach ($errors as $error) {
                    echo htmlspecialchars($error) . "<br>";
                }
                echo '</div>';
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
                <ion-icon name="eye-off-outline" id="togglePassword"></ion-icon>
                <input type="password" id="LoginPassword" name="LoginPassword" required placeholder=" ">
                <label for="LoginPassword">Password</label>
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
