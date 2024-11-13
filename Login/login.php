<?php
session_start();

require_once 'vendor/autoload.php';

// Google OAuth configuration
$clientID = 'YOUR_GOOGLE_CLIENT_ID';
$clientSecret = 'YOUR_GOOGLE_CLIENT_SECRET';
$redirectUri = 'http://yourdomain.com/login.php';

// Create Google Client
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('email');
$client->addScope('profile');

// If there is no authorization code, get it
if (!isset($_GET['code'])) {
    $authUrl = $client->createAuthUrl();
    echo "<a href='$authUrl'>Login with Google</a>";
} else {
    // Exchange authorization code for access token
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Get user profile information
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    
    // Store user information in session
    $_SESSION['id'] = $google_account_info->id;
    $_SESSION['email'] = $google_account_info->email;
    $_SESSION['name'] = $google_account_info->name;

    // Redirect to another page or display user info
    header('Location: dashboard.php');
    exit();
}
?>
