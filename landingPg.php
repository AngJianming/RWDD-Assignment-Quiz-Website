<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quiz Combat</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="description" content="Battle your friends in knowledge tests with Quiz Combat—a Python-powered quiz showdown." />
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
            position: fixed;
            width: 100%;
            z-index: 1000;
            background: #000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-content {
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
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9));
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
            margin: 0 auto;
            max-width: 1200px;
            padding: 4rem 0;
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

        @media (max-width: 640px) {
            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body class="dark-theme">
    <header class="global-nav">
        <div class="nav-content">
            <div class="logo-area">
                <!-- Example SVG Logo -->
                <a href="#" class="logo-link">
                    <svg width="40" height="40" viewBox="0 0 40 40" aria-hidden="true" fill="none">
                        <circle cx="20" cy="20" r="19" stroke="white" stroke-width="2" />
                        <text x="50%" y="50%" fill="white" text-anchor="middle" font-size="10" dy=".3em">QC</text>
                    </svg>
                    <span class="sr-only">Quiz Combat</span>
                </a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#leaderboard">Leaderboard</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#resources">Resources</a></li>
                </ul>
            </nav>
            <div class="actions">
                <a href="#login" class="login">Log in</a>
                <a href="#signup" class="cta">Sign up</a>
            </div>
        </div>
    </header>

    <main>
        <!-- HERO SECTION -->
        <section class="hero" id="home">
            <div class="hero-bg-overlay"></div>
            <video class="hero-video" autoplay muted loop playsinline>
                <!-- Replace with your own video or remove video and use a background image -->
                <source src="your-video.mp4" type="video/mp4" />
            </video>
            <div class="hero-content">
                <h1>Quiz Combat</h1>
                <p>Test your Python knowledge. Defeat your rivals. Become a quiz champion.</p>
                <div class="hero-cta">
                    <a href="#signup" class="hero-button">Start your challenge</a>
                </div>
            </div>
        </section>

        <!-- FEATURES SECTION -->
        <section class="features-section" id="features">
            <div class="container">
                <h2 class="section-title">Why Quiz Combat?</h2>
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

        <!-- RESOURCES SECTION -->
        <section class="resources-section" id="resources">
            <div class="container">
                <h2 class="section-title">Resources</h2>
                <ul class="resources-list">
                    <li><a href="#guides">Guides and Tips</a></li>
                    <li><a href="#api">API Documentation</a></li>
                    <li><a href="#community">Community Forum</a></li>
                    <li><a href="#help">Help Center</a></li>
                </ul>
            </div>
        </section>

    </main>

    <footer class="site-footer">
        <div class="container footer-content">
            <div class="footer-col">
                <h3>Quiz Combat</h3>
                <p>&copy; 2024 BatttleCombat.com FAQ | Privacy Policy | Terms of Service | RWDD Assignment Quiz Website </p>
            </div>
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
            </div>
            
        </div>
    </footer>
</body>

</html>