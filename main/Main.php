
<html lang="en" dir="US">

<head>
    <meta charset="UTF-8">
    <title>Responsive SideBar Menu</title>
    <link rel="stylesheet" href="/main/Main.css">
    <!-- Fluent UI CDN Link -->
    <link rel="stylesheet" href="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-core/11.0.0/css/fabric.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="ms-Fabric">

    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <img src="/img/RWDD logo.png" alt="Code Combat logo" style="height: min-; width: min-content">
                <!-- <i class="ms-Icon ms-Icon--Code"></i> -->
                <div class="logo_name">Code Combat</div>
            </div>
            <i class="ms-Icon ms-Icon--CollapseMenu" id="btn"></i>
        </div>
        
        <ul class="nav_list">
            <!-- <li>
                <i class="ms-Icon ms-Icon--Search"></i>
                <input type="text" placeholder="Search...">
                <span class="tooltip">Search</span>
            </li> -->
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
                    <span class="links_name">Play</span>
                </a>
                <span class="tooltip">Play</span>
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
                    <i class="ms-Icon ms-Icon--Code"></i>
                    <span class="links_name">Custom Quiz</span>
                </a>
                <span class="tooltip">Custom Quiz</span>
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
                    <img src="img/.jpg" alt="">
                    <div class="name_job">
                        <div class="name">Ang Jianming</div>
                        <div class="job">Full Stack Dev</div>
                    </div>
                </div>
                <i class="ms-Icon ms-Icon--SignOut" id="log_out"></i>
            </div>
        </div>
    </div>
    
    <!-- Main Page content will be here, don't mix with side bar stuff -->

    <div class="home_content">
        <!-- Content home principal page -->
        
        <div class="wrapper">
            <!-- Header -->
            <header class="header">
                <h1>Header</h1>
            </header>

            <!-- Main content -->
            <div class="content image-section">
                <p>Image</p>
            </div>

            <div class="content play-section">
                <p>Contents</p>
                <a href="">
                    <button class="play-button">Play</button>
                </a>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <p>Footer</p>
            </footer>
        </div>

    </div>
    <script src="/main/Main.js"></script>
</body>

</html>