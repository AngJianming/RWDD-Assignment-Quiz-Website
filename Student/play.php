<!-- play.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags and title -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Play Section</title>

    <!-- External CSS and Swiper.js stylesheets -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../Student/student-css/play.css">
    
    <!-- Include styles from Bg-Animation.php -->
    <?php include '../Constants/Combine-student.php'; ?>
</head>

<body>
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
            <!-- Original Play Button -->
            <div style="display:flex; gap:1rem; justify-content:center; align-items:center;">
                <button class="btn"><h2>Play</h2></button>
                <!-- New Buttons added at the side of the Play button -->
                <button class="btn">View Leaderboard</button>
                <button class="btn">View All Levels</button>
            </div>
        </div>
    </section>

    <!-- External JS scripts -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="../Student/student-js/play.js"></script>
</body>

</html>
