<?php
try {
    // Database connection
    $conn = new PDO("mysql:host=localhost;dbname=testdb", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $email = "example@example.com"; // Variable must be defined
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Fetch results
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        echo "User found: " . $user['name'];
    } else {
        echo "No user found with this email.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Start session
session_start();


// Handle Login Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check credentials in Admin table
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        // Start session and redirect to dashboard
        session_start();
        $_SESSION['user'] = $user;
        header("Location: dashboard.php"); // Change to your target page
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}

// If already logged in, redirect to dashboard
session_start();
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RWDD Assignment Quiz</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <section>
        <form action="login.php" method="POST">
            <!-- Display Error Message -->
            <?php
            if (!empty($error_msg)) {
                echo '<div class="error-message">' . htmlspecialchars($error_msg) . '</div>';
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
                <input type="email" id="LoginEmail" name="LoginEmail" required>
                <label for="LoginEmail">Email</label>
            </div>

            <!-- Password Input -->
            <div class="inputbox">
                <ion-icon name="eye-off-outline" id="togglePassword1" style="cursor: pointer;"></ion-icon>
                <input type="password" id="LoginPassword" name="LoginPassword" required>
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
            <button type="submit" name="submit" class="btn">Log in</button>


            <!-- Register Link -->
            <div class="register">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>

        </form>
    </section>

    <!-- Ionicons for Icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Password Toggle Script -->
    <script>
        const togglePassword1 = document.querySelector('#togglePassword1');
        const password1 = document.querySelector('#LoginPassword');

        togglePassword1.addEventListener('click', function() {
            // Toggle the type attribute
            const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
            password1.setAttribute('type', type);
            // Toggle the eye icon
            this.setAttribute('name', type === 'password' ? 'eye-off-outline' : 'eye-outline');
        });
    </script>

</body>

</html>