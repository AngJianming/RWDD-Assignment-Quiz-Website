<!DOCTYPE html>
<html lang="en" dir="US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="Student-Dashboard.css">

    <!-- Fluent UI CDN Link -->
    <link rel="stylesheet" href="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-core/11.0.0/css/fabric.min.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <div class="sidebar">
        <?php include("/xampp/htdocs/RWDD-Assignment-Quiz-Website/Constants/Sidebar-Student.php"); ?>
    </div>
</head>

<body class="ms-Fabric">


    <!-- Header -->

    <?php include("/xampp/htdocs/RWDD-Assignment-Quiz-Website/Constants/Header.php"); ?>

    <main>
        <article>
            <section class="section hero" id="home" aria-label="home" style="background-image:url(hero-bg.jpg);">
                <div class="container">
                    <div class="hero-content">
                        <p class="hero-subtitle" data-aos="zoom-in-right" data-aos-duration="1000" data-aos-delay="900">
                            Code Combat</p>
                        <h1 class="hero-title h1" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1100">
                            Quiz <span class="span">Levels</span> Matches</h1>
                        <p class="hero-text" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="1300">
                            Solve Python related question and compete with others in the global leaderboard.
                        </p>
                        <button class="btn skewBg" data-aos="zoom-out" data-aos-duration="1000"
                            data-aos-delay="1500">Play</button>
                    </div>
                    <figure class="hero-banner img-holder">
                        <img src="/img/RWDD bg-remover logo.png" alt="logo banner" class="w-100" data-aos="zoom-in-left"
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

    <!-- VV Footer VV -->

    <?php include("/xampp/htdocs/RWDD-Assignment-Quiz-Website/Constants/Footer.php"); ?>


</body>

</html>

<!-- 
<!DOCTYPE html>
<html>
<head>
<style>
div {
border: 1px solid gray;
padding: 8px;
}

h1 {
text-align: center;
text-transform: uppercase;
color: #4CAF50;
}

p {
text-indent: 50px;
text-align: justify;
letter-spacing: 3px;
}

a {
text-decoration: none;
color: #008CBA;
}
</style>
</head>
<body>

<div>
<h1>text formatting</h1>
<p>This text is styled with some of the text formatting properties. The heading uses the text-align, text-transform, and color properties.
The paragraph is indented, aligned, and the space between characters is specified. The underline is removed from this colored
<a target="_blank" href="tryit.asp?filename=trycss_text">"Try it Yourself"</a> link.</p>
</div>

</body>
</html> -->