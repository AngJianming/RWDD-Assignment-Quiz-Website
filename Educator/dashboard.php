<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible=" IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Combat for Educators</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-core/11.0.0/css/fabric.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="ms-Fabric">
    <!-- Main Content Container -->

    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <i class="ms-Icon ms-Icon--Code"></i>
                <div class="logo_name">logo</div>
            </div>
            <i class="ms-Icon ms-Icon--CollapseMenu" id="btn"></i>
        </div>
        <ul class="nav_list">   
            <li>
                <a href="#">
                    <i class="ms-Icon ms-Icon--WaffleOffice365"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="#">
                    <i class="ms-Icon ms-Icon--Contact"></i>
                    <span class="links_name">User</span>
                </a>
                <span class="tooltip">User</span>
            </li>
            <li>
                <a href="#">
                    <i class="ms-Icon ms-Icon--Chat"></i>
                    <span class="links_name">Chat</span>
                </a>
                <span class="tooltip">Chat</span>
            </li>
            <li>
                <a href="#">
                    <i class="ms-Icon ms-Icon--PieDouble"></i>
                    <span class="links_name">Analytics</span>
                </a>
                <span class="tooltip">Analytics</span>
            </li>
            <li>
                <a href="#">
                    <i class="ms-Icon ms-Icon--FabricFolder"></i>
                    <span class="links_name">File Manager</span>
                </a>
                <span class="tooltip">File Manager</span>
            </li>
            <li>
                <a href="#">
                    <i class="ms-Icon ms-Icon--ShoppingCart"></i>
                    <span class="links_name">Order</span>
                </a>
                <span class="tooltip">Order</span>
            </li>
            <li>
                <a href="#">
                    <i class="ms-Icon ms-Icon--Heart"></i>
                    <span class="links_name">Saved</span>
                </a>
                <span class="tooltip">Saved</span>
            </li>
            <li>
                <a href="#">
                    <i class="ms-Icon ms-Icon--Settings"></i>
                    <span class="links_name">Settings</span>
                </a>
                <span class="tooltip">Settings</span>
            </li>
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="img/WIN_20240717_15_03_12_Pro.jpg" alt="">
                    <div class="name_job">
                        <div class="name">Ang Jianming</div>
                        <div class="job">Full Stack Dev</div>
                    </div>
                </div>
                <i class="ms-Icon ms-Icon--SignOut" id="log_out"></i>
            </div>
        </div>
    </div>
    <div class="home_content">
        <!-- Content home principal page -->
        <div class="text">Home Content</div>
    </div>

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
            <p>Create engaging and effective quizzes effortlessly! Designed also for educators, our intuitive quiz page helps you craft interactive assessments that captivate students and track their progress. Perfect for enhancing classroom learning or online teaching.</h2>
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
        <button class="start-now-button">Start Now</button>
    </div>



</body>

</html>