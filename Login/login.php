<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="login.css">
    <title>Sign-in Sign-up form</title>
</head>

<body>
    <section>
        <form>
            <h1>Login</h1>
            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" required>
                <label for="">Email</label>
            </div>
            <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" required>
                <label for="">Password</label>
            </div>
            <div class="forget">
                <label for=""><input type="checkbox">Remember Me</label>
                <a href="#">Forget Password</a>
            </div>
            <button>Log in</button>
            <div class="register">
                <p>Don't have a account? <a href="#">Register</a></p>
            </div>
        </form>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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
