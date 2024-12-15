<?php
// register.php

// **1. Start the Session**
session_start();

// **2. Check if the Form is Submitted**
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // **3. Include Database Connection Script**
    // You can create a separate file for database connection and include it here.
    // For simplicity, we'll include the connection code directly.
    
    // Database credentials
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root'); // Default XAMPP username
    define('DB_PASS', '');     // Default XAMPP password is empty
    define('DB_NAME', 'rwdd-assignment-quiz-website'); // Your database name

    // Create a connection
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // **4. Retrieve and Sanitize User Inputs**
    $role = $mysqli->real_escape_string(trim($_POST['role']));
    $email = $mysqli->real_escape_string(trim($_POST['email']));
    $username = $mysqli->real_escape_string(trim($_POST['username']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $remember_me = isset($_POST['remember_me']) ? 1 : 0;

    // **5. Initialize an Errors Array**
    $errors = [];

    // **6. Validate Inputs**

    // a. Validate Role
    $valid_roles = ['Student', 'Educator', 'Admin'];
    if (!in_array($role, $valid_roles)) {
        $errors[] = "Invalid role selected.";
    }

    // b. Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // c. Validate Username
    if (empty($username)) {
        $errors[] = "Username is required.";
    } elseif (strlen($username) < 3 || strlen($username) > 50) {
        $errors[] = "Username must be between 3 and 50 characters.";
    }

    // d. Validate Password
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    // e. Confirm Password
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // **7. Check if Email or Username Already Exists**
    if (empty($errors)) {
        // Prepare a SELECT statement
        $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        if ($stmt) {
            $stmt->bind_param("ss", $email, $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $errors[] = "An account with this email or username already exists.";
            }
            $stmt->close();
        } else {
            $errors[] = "Database error: Unable to prepare statement.";
        }
    }

    // **8. If No Errors, Proceed to Insert the New User**
    if (empty($errors)) {
        // Hash the password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Prepare an INSERT statement
        $stmt = $mysqli->prepare("INSERT INTO users (role, email, username, password, remember_me) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssssi", $role, $email, $username, $password_hash, $remember_me);
            if ($stmt->execute()) {
                // Registration successful
                // Optionally, you can redirect to a login page or dashboard
                $_SESSION['success_message'] = "Registration successful! You can now log in.";
                header("Location: login.php");
                exit();
            } else {
                $errors[] = "Registration failed. Please try again.";
            }
            $stmt->close();
        } else {
            $errors[] = "Database error: Unable to prepare statement.";
        }
    }

    // **9. Close the Database Connection**
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Sign-up form</title>
</head>

<body>

    <section>
        <form>
            <!-- Register / Sign-up form-->
            <h1>Register / Sign-up</h1>

            <div class="radio-group">
                <input type="radio" id="student" name="role" value="Student">
                <label for="student">Student</label>

                <input type="radio" id="educator" name="role" value="Educator">
                <label for="educator">Educator</label>

                <input type="radio" id="admin" name="role" value="Admin">
                <label for="admin">Admin</label>
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" required>
                <label for="email">Email</label>
            </div>
            <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="text" required>
                <label for="username">Username</label>
            </div>
            <div class="inputbox">
                <ion-icon name="eye-off-outline" id="togglePassword1"></ion-icon>
                <input type="password" id="password1" required>
                <label for="password1">Add Password</label>
            </div>
            <div class="inputbox">
                <ion-icon name="eye-off-outline" id="togglePassword2"></ion-icon>
                <input type="password" id="password2" required>
                <label for="password2">Confirm Password</label>
            </div>

            <div class="forget">
                <label for=""><input type="checkbox" class="remember-me">Remember Me</label>
            </div>
            <button>Sign up</button>
            <div class="register">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>

        </form>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="register.js"></script>

    <?php

    // session_start();
    // require_once 'vendor/autoload.php';

    // // Google OAuth configuration
    // $clientID = 'YOUR_GOOGLE_CLIENT_ID';
    // $clientSecret = 'YOUR_GOOGLE_CLIENT_SECRET';
    // $redirectUri = 'http://yourdomain.com/registration.php';

    // // Database connection
    // $host = 'localhost';
    // $db = 'your_database_name';
    // $user = 'your_database_user';
    // $pass = 'your_database_password';

    // try {
    //     $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // } catch (PDOException $e) {
    //     die("Database connection failed: " . $e->getMessage());
    // }

    // // Create Google Client
    // $client = new Google_Client();
    // $client->setClientId($clientID);
    // $client->setClientSecret($clientSecret);
    // $client->setRedirectUri($redirectUri);
    // $client->addScope('email');
    // $client->addScope('profile');

    // if (!isset($_GET['code'])) {
    //     // If not authenticated yet, show Google login link
    //     $authUrl = $client->createAuthUrl();
    //     echo "<a href='$authUrl'>Register with Google</a>";
    // } else {
    //     // Exchange authorization code for access token
    //     $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    //     $client->setAccessToken($token);

    //     // Get user profile information
    //     $google_oauth = new Google_Service_Oauth2($client);
    //     $google_account_info = $google_oauth->userinfo->get();
    //     $google_id = $google_account_info->id;
    //     $email = $google_account_info->email;
    //     $name = $google_account_info->name;

    //     // Check if user already exists in the database
    //     $stmt = $pdo->prepare("SELECT * FROM users WHERE google_id = :google_id OR email = :email");
    //     $stmt->execute(['google_id' => $google_id, 'email' => $email]);
    //     $user = $stmt->fetch();

    //     if ($user) {
    //         // User already exists, so log them in
    //         $_SESSION['id'] = $user['id'];
    //         $_SESSION['email'] = $user['email'];
    //         $_SESSION['name'] = $user['name'];
    //         header('Location: dashboard.php');
    //         exit();
    //     } else {
    //         // User doesn't exist, so register them
    //         $stmt = $pdo->prepare("INSERT INTO users (google_id, email, name) VALUES (:google_id, :email, :name)");
    //         $stmt->execute(['google_id' => $google_id, 'email' => $email, 'name' => $name]);

    //         // Log the user in after registration
    //         $_SESSION['id'] = $pdo->lastInsertId();
    //         $_SESSION['email'] = $email;
    //         $_SESSION['name'] = $name;
    //         header('Location: dashboard.php');
    //         exit();
    //     }
    // }
    ?>

</body>

</html>