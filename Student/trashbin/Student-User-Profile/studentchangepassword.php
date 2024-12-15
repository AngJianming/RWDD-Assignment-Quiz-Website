<?php
session_start();
include("combine-student.php");
include("bganimation.php");
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="studentchangepassword.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <h1 style="color: white">Change Password</h1>
    <br>
    <div class="container">
        <h2>Enter your details</h2>
        <br><br>
        <form method="post">
            <input type="text" name="oldpass" placeholder="Old Password" required><br><br>
            <input type="text" name="newpass" placeholder="New Password" required><br><br>
            <input type="text" name="re_newpass" placeholder="Retype New Password" required>             
    </div>
            <button type="submit" name="savepass" class="changebutton">Change</button>
    </form>
</body>
</html>

<?php
if (isset($_POST['savepass'])) {
    // Ensure the necessary fields are set before processing
    if (isset($_POST['oldpass'], $_POST['newpass'], $_POST['re_newpass'])) {
        $student_email = $_SESSION['student_email']; // Assume student_email is stored in session
        $oldpass = $_POST['oldpass'];
        $newpass = $_POST['newpass'];
        $re_newpass = $_POST['re_newpass'];

        // Check if the new passwords match
        if ($newpass === $re_newpass) {
            // Retrieve the current password from the database
            $query = "SELECT student_password FROM student WHERE student_email = ?";
            $stmt = $connect_db->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement
                $stmt->bind_param("s", $student_email);
                $stmt->execute();
                $stmt->store_result(); // Store the result set to avoid "Commands out of sync" error
                $stmt->bind_result($current_password);
                $stmt->fetch(); // Fetch the result into the variable

                // Verify old password matches the current one
                if ($oldpass === $current_password) {

                    // Update the password in the database
                    $update_query = "UPDATE student SET student_password = ? WHERE student_email = ?";
                    $update_stmt = $connect_db->prepare($update_query);

                    if ($update_stmt) {
                        // Bind parameters for the update query
                        $update_stmt->bind_param("ss", $newpass, $student_email);
                        $update_success = $update_stmt->execute();

                        if ($update_success) {
                            echo "<script>alert('Password changed successfully');</script>";
                        } else {
                            echo "<script>alert('Error! Password change failed');</script>";
                        }

                        $update_stmt->close();
                    } 
                    else {
                        echo "<script>alert('SQL Error! Unable to update password');</script>";
                    }
                } 
                else {
                    echo "<script>alert('Old Password Incorrect');</script>";
                }

                // Close the statement after using it
                $stmt->close();
            } 
            else {
                echo "<script>alert('Error! Could not retrieve current password');</script>";
            }
        } 
        else {
            echo "<script>alert('New passwords do not match');</script>";
        }
    } 
    else {
        echo "<script>alert('Please fill all fields');</script>";
    }
}
?>
