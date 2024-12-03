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

    session_start();

    $link = mysqli_connect("localhost", "root", "", "rwdd-assignment-quiz-website");

    // Check connection
    if ($mysqli->connect_error) {
        // Log the error message internally
        error_log("Database connection error: " . $mysqli->connect_error);
        // Display a generic error message to the user
        die("Sorry, we're experiencing technical difficulties. Please try again later.");
    }
    echo "Connected successfully";

    // Initialize variables
    $loginEmail = isset($_POST['LoginEmail']) ? trim($_POST['LoginEmail']) : '';
    $loginPassword = isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : '';

    // Validate inputs
    if (empty($loginEmail) || empty($loginPassword)) {
        $_SESSION['errMsg'] = "Please enter both email and password.";
        header("Location: login.php"); // Redirect back to login form
        exit();
    }

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $mysqli->prepare("SELECT student_id, student_password FROM student WHERE student_email = ?");
    if (!$stmt) {
        error_log("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
        die("Sorry, we're experiencing technical difficulties. Please try again later.");
    }

    $stmt->bind_param("s", $loginEmail);

    // Execute the statement
    if (!$stmt->execute()) {
        error_log("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        die("Sorry, we're experiencing technical difficulties. Please try again later.");
    }

    // Bind the result variables
    $stmt->bind_result($student_id, $hashed_password);

    // Fetch the result
    if ($stmt->fetch()) {
        // Verify the password
        if (password_verify($loginPassword, $hashed_password)) {
            // Password is correct, regenerate session ID to prevent session fixation
            session_regenerate_id(true);
            $_SESSION['student_id'] = $student_id;
            exit();
        } else {
            // Invalid password
            $_SESSION['errMsg'] = "Invalid email or password.";
            header("Location: login.php");
            exit();
        }
    } else {
        // No user found with that email
        $_SESSION['errMsg'] = "Invalid email or password.";
        header("Location: login.php");
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $mysqli->close();
    ?>
</body>

</html>


