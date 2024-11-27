<?php
session_start();
$link = mysqli_connect("localhost", "root", "", "rwdd-assignment-quiz-website.sql"); //take care, you should avoid posting sensitive data 

if (mysqli_connect_error()) {

    die("There was an error connecting to the database");
}
$username = "";
$LoginEmail = (isset($_POST['LoginEmail']) &&
    !empty($_POST['LoginEmail'])) ? $_POST['LoginEmail'] : false;
$LoginPassword = (isset($_POST['LoginPassword']) &&
    !empty($_POST['LoginPassword'])) ? $_POST['LoginPassword'] : false;


$query = "SELECT `Email`,`ID`, `Password` FROM `StudentInfo` WHERE 
Email='" . $LoginEmail . "' AND Password='" . $LoginPassword . "'";
$result = mysqli_query($link, $query);
$count = mysqli_num_rows($result);
if ($count == 1) {
    $query = "SELECT `ID` FROM `StudentInfo` WHERE Email='" . $LoginEmail . "' AND Password='" . $LoginPassword . "'";
    $result = mysqli_query($link, $query);
    $array = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }
    $_SESSION['userid'] = $array['userid']; //instead of saving the complete row, you can save just the variable
    header("location: StudentInfo.php");
} else {

    $_SESSION['errMsg'] = "Invalid username or password";
}
