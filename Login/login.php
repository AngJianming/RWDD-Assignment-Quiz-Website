<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="login.css">
    <title>Login form</title>
</head>

<body>

    <section>
        <form>
            <!-- Login Form -->
            <h1>Login</h1>

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
                <label for="">Email</label>
            </div>
            <div class="inputbox">
                <ion-icon name="eye-off-outline" id="togglePassword1"></ion-icon>
                <input type="password" id="password1" required>
                <label for="password1">Password</label>
            </div>
            <div class="forget">
                <label for=""><input type="checkbox" class="remember-me">Remember Me</label>
                <a href="#">Forget Password</a>
            </div>
            <button>Log in</button>
            <div class="register">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>

        </form>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="register.js"></script>
</body>

</html>


<?php
// $servername = "localhost";
// $dbname = "rwdd-assignment-quiz-website";
// $username = "root";
// $password = "";

// // Create connection
// $conn = new mysqli($servername, $username, $password);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

// session_start();

// require_once 'vendor/autoload.php';

// // Google OAuth configuration
// $clientID = 'YOUR_GOOGLE_CLIENT_ID';
// $clientSecret = 'YOUR_GOOGLE_CLIENT_SECRET';
// $redirectUri = 'http://yourdomain.com/login.php';

// // Create Google Client
// $client = new Google_Client();
// $client->setClientId($clientID);
// $client->setClientSecret($clientSecret);
// $client->setRedirectUri($redirectUri);
// $client->addScope('email');
// $client->addScope('profile');

// // If there is no authorization code, get it
// if (!isset($_GET['code'])) {
//     $authUrl = $client->createAuthUrl();
//     echo "<a href='$authUrl'>Login with Google</a>";
// } else {
//     // Exchange authorization code for access token
//     $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
//     $client->setAccessToken($token);

//     // Get user profile information
//     $google_oauth = new Google_Service_Oauth2($client);
//     $google_account_info = $google_oauth->userinfo->get();

//     // Store user information in session
//     $_SESSION['id'] = $google_account_info->id;
//     $_SESSION['email'] = $google_account_info->email;
//     $_SESSION['name'] = $google_account_info->name;

//     // Redirect to another page or display user info
//     header('Location: dashboard.php');
//     exit();
// }
?>