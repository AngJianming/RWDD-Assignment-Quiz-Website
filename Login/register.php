<?php
session_start();
require_once 'vendor/autoload.php';

// Google OAuth configuration
$clientID = 'YOUR_GOOGLE_CLIENT_ID';
$clientSecret = 'YOUR_GOOGLE_CLIENT_SECRET';
$redirectUri = 'http://yourdomain.com/registration.php';

// Database connection
$host = 'localhost';
$db = 'your_database_name';
$user = 'your_database_user';
$pass = 'your_database_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Create Google Client
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('email');
$client->addScope('profile');

if (!isset($_GET['code'])) {
    // If not authenticated yet, show Google login link
    $authUrl = $client->createAuthUrl();
    echo "<a href='$authUrl'>Register with Google</a>";
} else {
    // Exchange authorization code for access token
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Get user profile information
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $google_id = $google_account_info->id;
    $email = $google_account_info->email;
    $name = $google_account_info->name;

    // Check if user already exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE google_id = :google_id OR email = :email");
    $stmt->execute(['google_id' => $google_id, 'email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        // User already exists, so log them in
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['name'];
        header('Location: dashboard.php');
        exit();
    } else {
        // User doesn't exist, so register them
        $stmt = $pdo->prepare("INSERT INTO users (google_id, email, name) VALUES (:google_id, :email, :name)");
        $stmt->execute(['google_id' => $google_id, 'email' => $email, 'name' => $name]);

        // Log the user in after registration
        $_SESSION['id'] = $pdo->lastInsertId();
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        header('Location: dashboard.php');
        exit();
    }
}
?>
