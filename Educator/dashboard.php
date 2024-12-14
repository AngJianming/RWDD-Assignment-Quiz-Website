<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible=" IE="edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Combat for Educators</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-core/11.0.0/css/fabric.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../Constants/Combine-educator.php'; ?>
</head>

<body class="ms-Fabric">

    

    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        let searchBtn = document.querySelector(".ms-Icon--Search");

        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }

        searchBtn.onclick = function() {
            sidebar.classList.toggle("active");
        }
    </script>

    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>Code Combat for Educators</h1>
        </div>

        <!-- Description Section -->
        <div class="description">
            <p style="text-align: justify;">Create engaging and effective quizzes effortlessly! Designed also for educators, our intuitive quiz page helps you craft interactive assessments that captivate students and track their progress. Perfect for enhancing classroom learning or online teaching.</h2>
            </p>
        </div>

        <!-- Features Section -->
        <div class="features">
            <!-- Feature 1 -->
            <div class="feature">
                <img src="images/bring ppl tgt.png" style="width: 200px; height: auto;">
                <h3>Bring students together with custom quizzes</h3>
                <p>Create and share quizzes that foster collaboration.</p>
            </div>

            <!-- Feature 2 -->
            <div class="feature">
                <img src="images/each device.png" style="width: 140px; height: 130px;">
                <h3>Students do the quiz from anywhere, anytime</h3>
                <p>Access quizzes remotely to support flexible learning.</p>
            </div>

            <!-- Feature 3 -->
            <div class="feature">
                <img src="images/practice py.png" style="width: 190px; height:130px;">
                <h3>Make coding with Python more interesting</h3>
                <p>Engage students with fun, interactive coding challenges.</p>
            </div>
        </div>
        <p class="starting-text">Ready to have a fun and engaging session with your students?</p>
        <a href="../Educator/Add-CustomQuiz.php" style='text-decoration: none;'>
            <button class="start-now-button">Start Now</button>
        </a>
    </div>



</body>

</html>