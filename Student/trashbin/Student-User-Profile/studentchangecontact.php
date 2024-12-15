<?php
session_start();
include("bganimation.php");
include("combine-student.php");
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="studentchangecontact.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student User Profile</title>
</head>
<body>
    <h1 style="color: white">Change Contact Number</h1>
    <br><br><br>
    <div class="container">
        <h2>Enter your details</h2>
        <br><br>
        <form method="post">
            <input type="tel" name="newcontact" placeholder="New Contact Number" required><br>       
    </div>
            <button type="submit" name="savecontact" class="changebutton">Change</button>
</form>
</body>
</html>

<?php
    if (isset($_POST['savecontact'])){
        #Retrieve id from the current logged in student and declare new contact
        $student_email = $_SESSION['student_email'];
        $newcontact = $_POST['newcontact'];

        #update the database
        $query = "UPDATE student SET student_contacts = ? WHERE student_email = ?";
        $stmt = $connect_db->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ss", $newcontact, $student_email); #s for string
            $success = $stmt->execute();

            if ($success) {
                echo "<script>alert('Contact Number changed successfully!');</script>";
            }
            else{
                echo "<script>alert('Error! Contact number change failed');</script>";
            }

            $stmt->close();
        }

        else {
            echo "<script>alert('SQL Failed');</script>";
        }

    }


?>
