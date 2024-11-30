<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include styles from Bg-Animation.php -->
    <?php include '/xampp/htdocs/RWDD-Assignment-Quiz-Website/Constants/Combine-student.php'; ?>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="play.css">
</head>
<body>
    <?php include '/xampp/htdocs/RWDD-Assignment-Quiz-Website/Constants/Bg-Animation.php'; ?>

    <!-- Main Content -->
    <section id="tranding">
        <div class="container">
            <!-- Swiper Slider -->
            <div class="swiper tranding-slider">
                <div class="swiper-wrapper">
                    <!-- Slide-start -->
                    <div class="swiper-slide tranding-slide">
                        <div class="tranding-slide-img">
                            <img src="https://i.pinimg.com/736x/51/75/2a/51752a173cded2cb0a53baaf7a596d81.jpg" alt="Level 1">
                        </div>
                    </div>
                    <!-- Slide-end -->
                    <!-- Slide-start -->
                    <div class="swiper-slide tranding-slide">
                        <div class="tranding-slide-img">
                            <img src="https://images.hdqwalls.com/wallpapers/python-logo-4k-i6.jpg" alt="Level 2">
                        </div>
                    </div>
                    <!-- Slide-end -->
                    <!-- Slide-start -->
                    <div class="swiper-slide tranding-slide">
                        <div class="tranding-slide-img">
                            <img src="https://a.storyblok.com/f/168723/1640x900/6132fdbe9a/cover-14.png/m/640x0" alt="Level 3">
                        </div>
                    </div>
                    <!-- Slide-end -->
                    <!-- Slide-start -->
                    <div class="swiper-slide tranding-slide">
                        <div class="tranding-slide-img">
                            <img src="https://4kwallpapers.com/images/wallpapers/python-logo-purple-2560x1440-16084.jpg" alt="Level 4">
                        </div>
                    </div>
                    <!-- Slide-end -->
                    <!-- Slide-start -->
                    <div class="swiper-slide tranding-slide">
                        <div class="tranding-slide-img">
                            <img src="https://4kwallpapers.com/images/walls/thumbs_2t/16015.jpg" alt="Level 5">
                        </div>
                    </div>
                    <!-- Slide-end -->
                </div>
            </div>
        </div>

        <!-- Slider Controls -->
        <div class="tranding-slider-control">
            <div class="swiper-button-prev slider-arrow">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </div>
            <div class="swiper-button-next slider-arrow">
                <ion-icon name="arrow-forward-outline"></ion-icon>
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="container">
            <h3 class="text-center section-subheading">-- Start Now --</h3>
            <button class="btn"><h2>Play</h2></button>
        </div>
    </section>

    <!-- External JS scripts -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="play.js"></script>
</body>
</html>