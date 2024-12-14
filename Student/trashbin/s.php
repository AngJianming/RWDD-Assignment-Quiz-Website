<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming-ProCoder</title>
    <link rel="stylesheet" href="../s.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Oxanium:wght@600;700;800&family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body id="top">
    <header class="header">
        <div class="header-bottom skewBg" data-header>
            <div class="container">
                <a href="#" class="logo" data-aos="zoom-in" data-aos-duration="1000">ProCoder</a>
                <nav class="navbar" data-navbar>
                    <ul class="navbar-list">
                        <li class="navbar-item" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100"><a
                                href="#home" class="navbar-link skewBg" data-nav-link>Home</a></li>
                        <li class="navbar-item" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"><a
                                href="#" class="navbar-link skewBg" data-nav-link>Live</a></li>
                        <li class="navbar-item" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300"><a
                                href="#" class="navbar-link skewBg" data-nav-link>Features</a></li>
                        <li class="navbar-item" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400"><a
                                href="#" class="navbar-link skewBg" data-nav-link>Shop</a></li>
                        <li class="navbar-item" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500"><a
                                href="#" class="navbar-link skewBg" data-nav-link>Blog</a></li>
                        <li class="navbar-item" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600"><a
                                href="#" class="navbar-link skewBg" data-nav-link>Contact</a></li>
                    </ul>
                </nav>
                <div class="header-actions">
                    <button class="cart-btn" aria-label="cart" data-aos="fade-left" data-aos-duration="1000"
                        data-aos-delay="700">
                        <ion-icon name="cart"></ion-icon>
                        <span class="cart-badge">0</span>
                    </button>
                    <button class="nav-toggle-btn" aria-label="toggle menu" data-nav-toggler>
                        <ion-icon name="menu-outline" class="menu"></ion-icon>
                        <ion-icon name="close-outline" class="close"></ion-icon>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <main>
        <article>
            <section class="section hero" id="home" aria-label="home" style="background-image:url(hero-bg.jpg);">
                <div class="container">
                    <div class="hero-content">
                        <p class="hero-subtitle" data-aos="zoom-in-right" data-aos-duration="1000" data-aos-delay="900">
                            Code Runner</p>
                        <h1 class="hero-title h1" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1100">
                            Create <span class="span">Manage</span> Matches</h1>
                        <p class="hero-text" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="1300">
                            Find technology or people for digital projects in public sector and find an indivdual
                            specialist develop researcher.
                        </p>
                        <button class="btn skewBg" data-aos="zoom-out" data-aos-duration="1000"
                            data-aos-delay="1500">Read More</button>
                    </div>
                    <figure class="hero-banner img-holder">
                        <img src="hero-banner.png" alt="hero-banner" class="w-100" data-aos="zoom-in-left"
                            data-aos-duration="2500">
                    </figure>
                </div>
            </section>
        </article>
    </main>
    <script src="script.js" defer></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({ offset: 0 });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>