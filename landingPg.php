<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">

<head>
    <title>Code Combat</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="description" content="Battle your friends in knowledge tests with Code Combat—a Python-powered quiz showdown." />
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22></svg>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        body.dark-theme {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #000;
            color: #fff;
        }

        a {
            color: #fff;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        a:hover {
            color: #ccc;
        }

        header.global-nav {
            height: 100px;
            position: fixed;
            display: flex;
            text-align: center;
            width: 100%;
            z-index: 1000;
            background: #000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            top: 0px;
        }

        .nav-content {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2rem;
        }

        .logo-link {
            display: flex;
            align-items: center;
        }

        .main-nav ul {
            display: flex;
            gap: 1.5rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .main-nav a {
            font-weight: 500;
        }

        .actions {
            display: flex;
            gap: 1rem;
        }

        .actions .login {
            font-weight: 500;
            background: #444;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            transition: background 0.2s ease;
        }

        .actions .cta {
            background: #444;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            transition: background 0.2s ease;
        }

        .actions .cta:hover {
            background: #555;
        }

        .hero {
            position: relative;
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-top: 4rem;
            text-align: center;
        }

        .hero-video {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .hero-bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9)); */
            z-index: -1;
        }

        .hero-content {
            max-width: 600px;
            padding: 2rem;
        }

        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 700;
            color: #00FFFF;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .hero-button {
            background: #444;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            transition: background 0.2s ease;
        }

        .hero-button:hover {
            background: #555;
        }

        .container {
            width: 90%;
            margin: 0px auto 0;
            max-width: 1200px;
            padding: 7rem 0;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 2rem;
            font-weight: 600;
            text-align: center;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: #111;
            padding: 2rem;
            border-radius: 8px;
            border: 1px solid #222;
        }

        .feature-card h3 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .footerCodeCombat {
            color: #00FFFF;
        }

        .feature-card p {
            font-size: 1rem;
            line-height: 1.5;
            color: #ccc;
        }

        .leaderboard-list {
            list-style: none;
            padding: 0;
            margin-top: 2rem;
        }

        .leaderboard-list li {
            display: flex;
            justify-content: space-between;
            background: #111;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            border: 1px solid #222;
        }

        .rank {
            font-weight: 700;
            color: #0f0;
            margin-right: 1rem;
        }

        .name {
            font-weight: 500;
            flex: 1;
        }

        .score {
            color: #ccc;
        }

        .resources-list {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
            padding: 0;
            margin-top: 2rem;
        }

        .resources-list li a {
            background: #111;
            padding: 1rem 1.5rem;
            border-radius: 6px;
            border: 1px solid #222;
            display: inline-block;
            font-weight: 500;
        }

        .resources-list li a:hover {
            background: #222;
        }

        .site-footer {
            background: #000;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 3rem 0;
            font-size: 0.9rem;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: space-between;
        }

        .footer-col h3 {
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .footer-col ul {
            list-style: none;
            padding: 0;
        }

        .footer-col li {
            margin-bottom: 0.5rem;
        }

        .footer-col a {
            color: #ccc;
            font-weight: 400;
        }

        .footer-col a:hover {
            color: #fff;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links li a {
            font-weight: 500;
            border-bottom: 1px dashed #444;
        }

        .social-links li a:hover {
            border-bottom: 1px dashed #fff;
        }

        /* Container and Heading Styles */
        .team {
            background: #000;
            color: #fff;
            padding: 4rem 0;
            text-align: center;
            font-family: 'Inter', sans-serif;
        }

        .team .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .title-w3-agileits.title-black-wthree {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 3rem;
            color: #fff;
            text-transform: uppercase;
        }

        /* Tabs Container */
        #horizontalTab {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Tab Navigation (Team Member Thumbnails) */
        .resp-tabs-list {
            display: flex;
            gap: 2rem;
            list-style: none;
            margin-bottom: 3rem;
            padding: 0;
        }

        .resp-tabs-list li {
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .resp-tabs-list li:hover {
            transform: scale(1.05);
        }

        .resp-tabs-list li img {
            display: block;
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #333;
        }

        /* Tab Content Area */
        .resp-tabs-container {
            width: 100%;
        }

        /* Each Tab Content */
        .resp-tabs-container>div {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            background: #111;
            padding: 2rem;
            border: 1px solid #222;
            border-radius: 8px;
        }

        /* Team Member Image Section */
        .team-img-w3-agile {
            flex: 1 1 300px;
            min-height: 200px;
            background: #000;
            border-radius: 8px;
            border: 1px solid #222;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Placeholder for where you'd put a background image or a styled element */
        .team-img-w3-agile::before {
            content: "Member Image";
            color: #555;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        /* Team Member Info */
        .team-Info-agileits {
            flex: 1 1 300px;
            text-align: left;
        }

        .team-Info-agileits h4 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #fff;
        }

        .team-Info-agileits span {
            display: block;
            font-size: 0.9rem;
            color: #aaa;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .team-Info-agileits p {
            font-size: 1rem;
            line-height: 1.6;
            color: #ccc;
            margin-bottom: 1.5rem;
        }

        /* Social Icons */
        .social-bnr-agileits.footer-icons-agileinfo {
            margin-top: 1rem;
        }

        .social-icons3 {
            list-style: none;
            display: flex;
            gap: 1rem;
            padding: 0;
        }

        .social-icons3 li a {
            color: #ccc;
            font-size: 1.1rem;
            transition: color 0.2s ease;
        }

        .social-icons3 li a:hover {
            color: #fff;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .resp-tabs-list li img {
                width: 80px;
                height: 80px;
            }

            .team-Info-agileits h4 {
                font-size: 1.2rem;
            }

            .team-Info-agileits p {
                font-size: 0.95rem;
            }
        }

        @media (max-width: 480px) {
            .resp-tabs-list {
                gap: 1rem;
            }

            .resp-tabs-list li img {
                width: 60px;
                height: 60px;
            }
        }


        @media (max-width: 640px) {
            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }
        }
    </style>
    <?php //include '/xampp/htdocs/RWDD-Assignment-Quiz-Website/Constants/Bg-Animation.php';
    ?>

</head>


<body class="dark-theme">
    <header class="global-nav">
        <div class="nav-content">
            <div class="logo-area">
                <!-- Example SVG Logo -->
                <a href="#" class="logo-link">
                    <img src="/img/Code-Combat (trans) logo.png" alt="Logo" width="120px" height="40px">
                    <!-- <svg width="40" height="40" viewBox="0 0 40 40" aria-hidden="true" fill="none">
                        <circle cx="20" cy="20" r="19" stroke="white" stroke-width="2" />
                        <text x="50%" y="50%" fill="white" text-anchor="middle" font-size="10" dy=".3em">QC</text>
                    </svg> -->
                    <!-- <span class="sr-only">Code Combat</span> -->
                </a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#leaderboard">Leaderboard</a></li>
                    <li><a href="#aboutus">About Us</a></li>
                    <li><a href="#resources">Resources</a></li>
                </ul>
            </nav>
            <div class="actions">
                <a href="/Login/login.php" class="login">Log in</a>
                <a href="/Login/register.php" class="cta">Sign up</a>
            </div>
        </div>
    </header>

    <main>
        <!-- HERO SECTION -->
        <section class="hero" id="home">
            <div class="hero-bg-overlay"></div>
            <video class="hero-video" autoplay muted loop playsinline>
                <!-- Replace with your own video or remove video and use a background image -->
                <source src="/vid/Purple Matrix vid.mp4" type="video/mp4" />
            </video>
            <div class="hero-content">
                <h1>Code Combat</h1>
                <p>Test your Python knowledge. Defeat your rivals. Become a quiz champion.</p>
                <div class="hero-cta">
                    <a href="#signup" class="hero-button">Start your challenge</a>
                </div>
            </div>
        </section>

        <!-- FEATURES SECTION -->
        <section class="features-section" id="features">
            <div class="container">
                <h2 class="section-title">Why Code Combat?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <h3>Real-time Battles</h3>
                        <p>Challenge friends or random opponents in real-time Python-powered quiz duels.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Curated Topics</h3>
                        <p>From history to science, pick a topic and show off your expertise.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Adaptive Difficulty</h3>
                        <p>The better you get, the tougher the questions. Prove your mastery.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Global Leaderboards</h3>
                        <p>Climb the ranks, earn badges, and showcase your quiz prowess worldwide.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- LEADERBOARD SECTION -->
        <section class="leaderboard-section" id="leaderboard">
            <div class="container">
                <h2 class="section-title">Top Warriors</h2>
                <p class="section-subtitle">Check out who’s currently dominating the arena.</p>
                <ul class="leaderboard-list">
                    <li>
                        <span class="rank">#1</span>
                        <span class="name">Triviaking99</span>
                        <span class="score">Score: 4580</span>
                    </li>
                    <li>
                        <span class="rank">#2</span>
                        <span class="name">PythonMaster</span>
                        <span class="score">Score: 4320</span>
                    </li>
                    <li>
                        <span class="rank">#3</span>
                        <span class="name">KnowItAll</span>
                        <span class="score">Score: 4210</span>
                    </li>
                </ul>
            </div>
        </section>

        <!-- ABOUT US SECTION -->
        <div class="team" id="aboutus">
            <div class="container">
                <h3 class="title-w3-agileits title-black-wthree">Meet Our Team</h3>
                <div id="horizontalTab">
                    <ul class="resp-tabs-list">
                        <li>
                            <img src="images/yAng.png" alt="Member1" class="img-responsive" href="TM1"/>
                        </li>
                        <li>
                            <img src="images/yBeh.png" alt="Member2" class="img-responsive" href="TM2"/>
                        </li>
                        <li>
                            <img src="images/yHJ.png" alt="Member3" class="img-responsive" href="TM3"/>
                        </li>
                        <li>
                            <img src="images/yCho.png" alt="Member4" class="img-responsive" href="TM4"/>
                        </li>
                        <li>
                            <img src="images/yCho.png" alt="Member5" class="img-responsive" href="TM5"/>
                        </li>
                        <li>
                            <img src="images/yCho.png" alt="Member6" class="img-responsive" href="TM6"/>
                        </li>
                    </ul>
                    <div class="resp-tabs-container">
                        <div class="tab1" id="TM1">
                            <div class="col-md-6 team-img-w3-agile">
                            </div>
                            <div class="col-md-6 team-Info-agileits">
                                <h4>Ang Jianming</h4>
                                <span>Full-stack Developer</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.Lorem ipsum dolor .</p>
                                <div class="social-bnr-agileits footer-icons-agileinfo">
                                    <ul class="social-icons3">
                                        <li><a href="#" class="fa fa-facebook icon-border facebook"> </a></li>
                                        <li><a href="#" class="fa fa-twitter icon-border twitter"> </a></li>
                                        <li><a href="#" class="fa fa-google-plus icon-border googleplus"> </a></li>
                                        <li><a href="#" class="fa fa-rss icon-border rss"> </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="tab2" id="TM2">
                            <div class="col-md-6 team-img-w3-agile">
                            </div>
                            <div class="col-md-6 team-Info-agileits">
                                <h4>Elvan Sea Meng Ji</h4>
                                <span>Leader / Product manager</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.Lorem ipsum dolor .</p>
                                <div class="social-bnr-agileits footer-icons-agileinfo">
                                    <ul class="social-icons3">
                                        <li><a href="#" class="fa fa-facebook icon-border facebook"> </a></li>
                                        <li><a href="#" class="fa fa-twitter icon-border twitter"> </a></li>
                                        <li><a href="#" class="fa fa-google-plus icon-border googleplus"> </a></li>
                                        <li><a href="#" class="fa fa-rss icon-border rss"> </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="tab3" id="TM3">
                            <div class="col-md-6 team-img-w3-agile">
                            </div>
                            <div class="col-md-6 team-Info-agileits">
                                <h4>Jayden Foo Lok Hin</h4>
                                <span>Backend Developer</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.Lorem ipsum dolor .</p>
                                <div class="social-bnr-agileits footer-icons-agileinfo">
                                    <ul class="social-icons3">
                                        <li><a href="#" class="fa fa-facebook icon-border facebook"> </a></li>
                                        <li><a href="#" class="fa fa-twitter icon-border twitter"> </a></li>
                                        <li><a href="#" class="fa fa-google-plus icon-border googleplus"> </a></li>
                                        <li><a href="#" class="fa fa-rss icon-border rss"> </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="tab4" id="TM4">
                            <div class="col-md-6 team-img-w3-agile">
                            </div>
                            <div class="col-md-6 team-Info-agileits">
                                <h4>Kee Genni</h4>
                                <span>Frontend Developer</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.Lorem ipsum dolor .</p>
                                <div class="social-bnr-agileits footer-icons-agileinfo">
                                    <ul class="social-icons3">
                                        <li><a href="#" class="fa fa-facebook icon-border facebook"> </a></li>
                                        <li><a href="#" class="fa fa-twitter icon-border twitter"> </a></li>
                                        <li><a href="#" class="fa fa-google-plus icon-border googleplus"> </a></li>
                                        <li><a href="#" class="fa fa-rss icon-border rss"> </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="tab5" id="TM5">
                            <div class="col-md-6 team-img-w3-agile">
                            </div>
                            <div class="col-md-6 team-Info-agileits">
                                <h4>Lai Xiao Chun (Aurora)</h4>
                                <span>UIUX Designer</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.Lorem ipsum dolor .</p>
                                <div class="social-bnr-agileits footer-icons-agileinfo">
                                    <ul class="social-icons3">
                                        <li><a href="#" class="fa fa-facebook icon-border facebook"> </a></li>
                                        <li><a href="#" class="fa fa-twitter icon-border twitter"> </a></li>
                                        <li><a href="#" class="fa fa-google-plus icon-border googleplus"> </a></li>
                                        <li><a href="#" class="fa fa-rss icon-border rss"> </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="tab6" id="TM6">
                            <div class="col-md-6 team-img-w3-agile">
                            </div>
                            <div class="col-md-6 team-Info-agileits">
                                <h4>Yip Zhi Heng</h4>
                                <span>Backend Developer</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.Lorem ipsum dolor .</p>
                                <div class="social-bnr-agileits footer-icons-agileinfo">
                                    <ul class="social-icons3">
                                        <li><a href="#" class="fa fa-facebook icon-border facebook"> </a></li>
                                        <li><a href="#" class="fa fa-twitter icon-border twitter"> </a></li>
                                        <li><a href="#" class="fa fa-google-plus icon-border googleplus"> </a></li>
                                        <li><a href="#" class="fa fa-rss icon-border rss"> </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RESOURCES SECTION -->
        <section class="resources-section" id="resources">
            <div class="container">
                <h2 class="section-title">Resources</h2>
                <ul class="resources-list">
                    <li><a href="#guides">Guides and Tips</a></li>
                    <li><a href="#api">Documentation</a></li>
                    <li><a href="#community">Community Forum</a></li>
                    <li><a href="#help">Help Center</a></li>
                </ul>
            </div>
        </section>

    </main>

    <footer class="site-footer">
        <div class="container footer-content">
            <div class="footer-col">
                <h3 class="footerCodeCombat">Code Combat</h3>
                <p>&copy; 2024 BatttleCombat.com FAQ | Privacy Policy | Terms of Service | RWDD Assignment Quiz Website </p>
                <!-- </div>
            <div class="footer-col">
                <h3>Company</h3>
                <ul>
                    <li><a href="#about">About</a></li>
                    <li><a href="#careers">Careers</a></li>
                    <li><a href="#press">Press</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Support</h3>
                <ul>
                    <li><a href="#help">Help Center</a></li>
                    <li><a href="#forum">Community Forum</a></li>
                    <li><a href="#guides">Guides</a></li>
                </ul>
            </div> -->
            </div>
    </footer>
</body>

</html>