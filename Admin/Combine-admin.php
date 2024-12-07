<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Responsive SideBar Menu</title>
    <!-- Fluent UI CDN Link -->
    <link rel="stylesheet" href="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-core/11.0.0/css/fabric.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <?php include '../Constants/Bg-Animation.php'; ?>

    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        #btn {
            margin: 0;
            cursor: pointer;
        }

        #log_out {
            margin: 0;
            cursor: pointer;
        }

        body {
            position: relative;
            min-height: 100vh;
            width: 100%;
            overflow: hidden;
            /* background: #444; */
            /* background-color: #5c3d9a; */
        }

        header {
            position: fixed;
            top:0;
            left:0;
            width: 100%;
            background-color: #2d0d3f;
            color: white;
            width: 100%;
            top: 0;

        }

        .header-container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px;
        }

        .logo {
            max-width: 96px;
            max-height: 96px;
            margin: 0 auto;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 24px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        .search-signup {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-signup input {
            padding: 8px;
            border-radius: 4px;
            border: none;
        }

        .sign-in,
        .sign-up {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
        }

        .sign-in {
            background-color: #dadada;
            color: #333;
        }

        .sign-up {
            background-color: #6e30a8;
            color: white;
        }
        
        .sign-in:hover {
            background-color: #ffffff;
            color: #333;
        }

        .sign-up:hover {
            background-color: #a94dff;
            color: white;
        }

        img {
            width: 144px;
            height: 48px;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 80px;
            /* Adjusted width */
            background: #2d0d3f;
            padding: 12px 10px;
            transition: all 0.5s ease;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            /* z-index to ensure it will always be above other */
        }

        .sidebar.active {
            width: 320px;
            /* Adjusted active width */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3);
        }

        .sidebar .logo_content .logo {
            color: #FFF;
            display: flex;
            height: 50px;
            width: 100%;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: all 0.5s ease;
        }

        .sidebar.active .logo_content .logo {
            opacity: 1;
            pointer-events: none;
        }

        .logo_content .logo img {
            margin-top: 30px;
            width: 150px;
            height: 45px;
        }

        .logo_content .logo .logo_name {
            font-size: 20px;
            font-weight: 400;
            transition: opacity 0.5s ease;
        }

        /* collapse button */
        .sidebar #btn {
            position: absolute;
            color: #FFF;
            top: 15px;
            left: 30px;
            font-size: 30px;
            height: 50px;
            width: 50px;
            text-align: center;
            line-height: 50px;
            transform: translateX(-30%);
            transition: transform 0.5s ease-in-out, color 0.5s ease-in-out;
        }

        .sidebar.active #btn {
            left: 80%;
            transform: rotate(180deg);
        }

        .sidebar ul {
            margin-top: 35px;
            transition: opacity 0.5s ease-in-out;
        }

        .sidebar.active ul {
            opacity: 1;
        }

        .sidebar ul li {
            position: relative;
            height: 60px;
            /* Reduced height */
            width: 100%;
            margin: 10px 0;
            /* Adjusted margin for better spacing */
            list-style: none;
            line-height: 60px;
            /* Adjusted line-height to match new height */
        }

        .sidebar ul li .tooltip {
            position: absolute;
            left: 110px;
            /* Adjusted positioning */
            top: 50%;
            transform: translateY(-50%);
            border-radius: 6px;
            height: 30px;
            /* Reduced height */
            width: 100px;
            /* Reduced width */
            background: #FFF;
            line-height: 30px;
            /* Match height */
            text-align: center;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            opacity: 0;
            pointer-events: none;
            display: block;
        }

        .sidebar.active ul li .tooltip {
            display: none;
        }

        .sidebar ul li:hover .tooltip {
            opacity: 1;
            top: 60%;
            /* Adjusted for smoother appearance */
        }

        .sidebar ul li input {
            position: absolute;
            height: 100%;
            width: 100%;
            left: 0;
            top: 0;
            border-radius: 12px;
            outline: none;
            border: none;
            background: #1D1B31;
            padding-left: 50px;
            font-size: 16px;
            color: #FFF;
        }

        .sidebar ul li span {
            font-size: 14.4px;
            /* Reduced font size for links */
        }

        .sidebar ul li a {
            color: #FFF;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 12px;
            white-space: nowrap;
        }

        .sidebar ul li a:hover {
            color: #11101D;
            background: #FFF;
        }

        .sidebar ul li i {
            height: 60px;
            /* Reduced height */
            min-width: 60px;
            /* Reduced min-width */
            border-radius: 12px;
            line-height: 60px;
            /* Match height */
            text-align: center;
            font-size: 19.2px;
            /* Reduced font size */
        }

        /* Specific Adjustments for Font Awesome Icons */
        .sidebar ul li a .fa-gamepad-modern,
        .sidebar ul li a .fa-pen-field,
        .sidebar ul li a .fa-trophy,
        .sidebar ul li a .fa-clock-rotate-left {
            font-size: 19.2px;
            /* consistent with Fluent UI icons */
        }

        .sidebar .links_name {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.5s ease;
        }

        .sidebar.active .links_name {
            opacity: 1;
            pointer-events: auto;
            transition: all 0.5s ease;
        }

        .sidebar .profile_content {
            position: absolute;
            color: #FFF;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .sidebar .profile_content .profile {
            position: relative;
            padding: 8px 0px;
            height: 80px;
            background: none;
            transition: all 0.5s ease-in-out;
        }

        .sidebar.active .profile_content .profile {
            background: #1D1B31;
        }

        .profile_content .profile .profile_details {
            display: flex;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            white-space: nowrap;
            transition: opacity 0.5s ease;
        }

        .sidebar.active .profile .profile_details {
            opacity: 1;
            pointer-events: auto;
        }

        .profile .profile_details img {
            height: 70px;
            /* Reduced size */
            width: 70px;
            /* Reduced size */
            object-fit: cover;
            border-radius: 6px;
            margin-left: 16px;
        }

        .profile .profile_details .name_job {
            margin-left: 10px;
        }

        .profile .profile_details .name {
            font-size: 15px;
            font-weight: 400;
        }

        .profile .profile_details .job {
            font-size: 12px;
        }

        .profile #log_out {
            position: absolute;
            bottom: 20px;
            /* Adjusted positioning */
            left: 50%;
            transform: translateX(-50%);
            min-width: 40px;
            /* Reduced width */
            line-height: 40px;
            /* Match min-width */
            font-size: 25px;
            /* Reduced font size */
            border-radius: 12px;
            text-align: center;
            transition: transform 0.5s ease-in-out;
            background: #1D1B31;
        }

        .sidebar.active .profile #log_out {
            left: 88%;
            background: none;
            rotate: (180deg);
        }

        /* When Sidebar is Active */
        .sidebar.active~.home_content {
            width: calc(100% - 320px);
            /* Adjusted width */
            left: 320px;
            /* Adjusted left position */
        }

        /* Footer */
        footer {
            background-color: #2d0d3f;
            color: white;
            padding: 32px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer-container {
            display: flex;
            justify-content: space-around;
        }

        .footer-section h4 {
            color: #ff005c;
            margin-bottom: 16px;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li a {
            color: #ccc;
            text-decoration: none;
        }

        .footer-section ul li a:hover {
            color: white;
        }

        .social-icons a {
            color: #ccc;
            margin: 0 8px;
            text-decoration: none;
            font-size: 19.2px;
        }

        .social-icons a:hover {
            color: #ff005c;
        }
        
        .copyright {
            color: #f5f5f5;
            text-align: center;
            padding: 0px;
            margin-top: 0px;
            margin-bottom: -4px;
            font-size: 20px;
        }

        /* Responsive Adjustments */
        @media (max-width: 932px) {

            /* Collapse the sidebar by default */
            .sidebar {
                width: 50px;
                /* Reduced from 70px */
                transition: all 0.5s ease;
            }

            /* Hide the navigation list and profile content by default */
            .sidebar .nav_list,
            .sidebar .profile_content {
                display: none;
            }

            /* Expand the sidebar and show contents when active */
            .sidebar.active {
                width: 200px;
                /* Reduced from 250px */
            }

            .sidebar.active .nav_list,
            .sidebar.active .profile_content {
                display: block;
            }

            /* Adjust the home content width when sidebar is active */
            .home_content {
                width: calc(100% - 50px);
                /* Adjusted width */
                left: 50px;
                /* Adjusted left position */
                transition: margin-left 0.5s ease;
            }

            .sidebar.active~.home_content {
                width: calc(100% - 200px);
                /* Adjusted width */
                left: 200px;
                /* Adjusted left position */
            }

            /* Center the menu button */
            .sidebar #btn {
                left: 50%;
                transform: translateX(-50%);
            }

            /* Further reduce icon sizes in responsive mode */
            .sidebar ul li i {
                font-size: 1rem;
                /* Further reduced font size */
            }

            /* Further reduce tooltip sizes in responsive mode */
            .sidebar ul li .tooltip {
                width: 80px;
                /* Further reduced width */
                height: 25px;
                /* Further reduced height */
                line-height: 25px;
                /* Match height */
                font-size: 12.8px;
                /* Reduced font size */
            }

            /* Adjust Font Awesome icons in responsive mode */
            .sidebar ul li a .fa-gamepad-modern,
            .sidebar ul li a .fa-pen-field,
            .sidebar ul li a .fa-trophy,
            .sidebar ul li a .fa-clock-rotate-left {
                font-size: 16px;
                /* Further reduced font size */
            }

            /* Adjust logout icon size in responsive mode */
            .profile #log_out {
                font-size: 20px;
                /* Further reduced font size */
                min-width: 35px;
                /* Further reduced width */
                line-height: 35px;
                /* Match min-width */
            }
        }

        /* for header */
        @media (max-width: 100px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            nav ul {
                flex-direction: column;
                gap: 8px;
                margin-top: 8px;
            }

            .search-signup {
                flex-direction: column;
                width: 100%;
                margin-top: 16px;
            }

            .search-signup input {
                width: 100%;
            }

            footer .footer-container {
                flex-direction: column;
                gap: 16px;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 8px;
            }

            .footer-container {
                padding: 16px;
                font-size: 14.4px;
            }

            .search-signup input {
                width: 100%;
                margin-bottom: 8px;
            }
        }

        /* for footer */
        @media (max-width: 932px) {
            /* Collapse move lower by width */
            
        }
    </style>
</head>

<body class="ms-Fabric">
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="../img/Code-Combat (trans) logo.png" alt="Logo" />
            </div>
            <!-- <div class="search-signup">
                <button class="sign-in">Sign in</button>
                <button class="sign-up">Sign up</button>
            </div> -->
        </div>
    </header>   

    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
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
                    <span class="links_name">Manage User Account</span>
                </a>
                <span class="tooltip">Manage User Account</span>
            </li>
            <li>
                <a href="#">
                    <i class="ms-Icon ms-Icon--Chat"></i>
                    <span class="links_name">Manage Performance</span>
                </a>
                <span class="tooltip">Manage Performance</span>
            </li>
            <li>
                <a href="#">
                    <i class="ms-Icon ms-Icon--PieDouble"></i>
                    <span class="links_name">Manage Educator Account</span>
                </a>
                <span class="tooltip">Manage Educator Account</span>
            </li>
            <li>
                <a href="#">
                    <i class="ms-Icon ms-Icon--FabricFolder"></i>
                    <span class="links_name">Files</span>
                </a>
                <span class="tooltip">Files</span>
            </li>
            <li>
                <a href="../Admin/rankedquiz.php">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span class="links_name">Add Quiz</span>
                </a>
                <span class="tooltip">Add Quiz</span>
            </li>
            <!-- <li>
                <a href="#">
                    <i class="ms-Icon ms-Icon--Settings"></i>
                    <span class="links_name">Settings</span>
                </a>
                <span class="tooltip">Settings</span>
            </li> -->
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="../img/Profile Pic.png" alt="Profile Picture">
                    <div class="name_job">
                        <div class="name">USER</div>
                        <div class="job">Admin</div>
                    </div>
                </div>
                <i class="ms-Icon ms-Icon--SignOut" id="log_out"></i>
            </div>
        </div>
    </div>

    <footer>
        <div class="copyright">
            <h6>© 2024 BatttleCombat.com FAQ | Privacy Policy | Terms of Service | RWDD Assignment Quiz Website</h4>
        </div>
    </footer>
    <div class="home_content">
        <!-- Main content goes here -->

    </div>

    <script>
        const btn = document.querySelector("#btn");
        const sidebar = document.querySelector(".sidebar");

        // Toggle sidebar on button click
        btn.addEventListener('click', function(event) {
            sidebar.classList.toggle("active");
            // Prevent the click from propagating to the document
            event.stopPropagation();
        });

        // Prevent clicks inside the sidebar from closing it
        sidebar.addEventListener('click', function(event) {
            event.stopPropagation();
        });

        // Close sidebar when clicking outside of it
        document.addEventListener('click', function(event) {
            // If the sidebar is active, remove the "active" class to hide it
            if (sidebar.classList.contains("active")) {
                sidebar.classList.remove("active");
            }
        });
    </script>
</body>

</html>