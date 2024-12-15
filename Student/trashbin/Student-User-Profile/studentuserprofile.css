<?php
session_start();
include("combine-student.php");
include("bganimation.php");
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="studentuserprofile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student User Profile</title>
</head>
<body>
    <?php
        if (isset($_SESSION['student_email'])) {
            $student_email = $_SESSION['student_email'];
            $query = "SELECT student_username, student_contacts FROM student WHERE student_email = ?";
            $stmt = $connect_db->prepare($query);
            $stmt->bind_param("s", $student_email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $student = $result->fetch_assoc();
                $student_username = $student['student_username'];
                $student_contacts = $student['student_contacts'];

            }
            else {
                echo "Student details not found";
            }
        

            echo '<h1 style="color: white">Your User Profile</h1>';
            echo '<br><br><br>';
            echo '<div class="container">';
                echo '<h2>Username: ' . $student_username . '</h2>';
                echo '<br><br>';
                echo '<h2>Email: ' . $student_email . '</h2>';
                echo '<br><br>';
                echo '<form action="studentchangecontact.php" method="GET" style="display: inline;">
                    <h2>Contact: ' . $student_contacts .
                    '<button name="cqenter" class="button"><b>&gt;</b></button>
                    </h2>
                    </form>';
                echo '<br><br>';
                echo '<form action="studentchangepassword.php" method="GET" style="display: inline;">
                    <h2>Change Password
                    <button name="cqenter" class="button"><b>&gt;</b></button>
                    </h2>
                    </form>';
                echo '</p>';
            echo '</div>';
        }
    ?>
</body>
</html>
