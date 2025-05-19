<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - About Us </title>
    <style>
        .header {
            margin: 0% auto;
            background: url('Image/rooms/4.jpeg') center/cover no-repeat;
            background-size: 100%;
            padding: 15% 0;
            color: white;
            font-size: 20px;
            text-shadow: 3px 3px 4px rgba(0, 0, 0, 0.5);
        }

        .header .h-font {
            font-family: 'Poppins', sans-serif;
            font-size: 100px;
        }

        .history {
            padding: 10%;
        }

        .vision {
            padding: 10%;
        }

        .box{
            border-top-color: var(--teal) !important;
        }

        .my-5 > .fw-bold{
            animation: slideIn 1.2s ease forwards;
        }

        .my-5 > .mt-3 {
            animation: slideIn 1.5s ease forwards;
        }

        @keyframes slideIn {
        from {
            transform: translateY(100px);
        }
        to {
            transform: translateY(0);
        }
        }
        
        .fade-in-container {
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 1.5s ease, transform 2.0s ease;
        }

        .fade-in-image {
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 1.5s ease, transform 2.0s ease;
        }

        .fade-in-text {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1.5s ease, transform 2.5s ease;
        }

        .stuff .col-lg-3:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }

        .swiper .swiper-slide:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
        </style>
</head>
<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="header">
        <div class="my-5 px-4">
            <h2 class="fw-bold h-font text-center" >ABOUT US</h2>
            <p class="text-center mt-3">
            Welcome to Neru Hotel, where history and hospitality unite to offer you a unique experience. 
            </p>
        </div>
    </div>

    <div class="history">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6 col-md-5 order-lg-1 order-md-1 order-2 fade-in-container">
                    <h3 class="mb-3">Our History</h3><!--Name-->
                    <p>
                        <!-- description -->
                        Our story dates back to 1950, when our founder, Wong Lok Wun, embarked on a mission to 
                        create a haven of comfort and luxury for travelers. Originally a modest inn, Neru Hotel quickly
                        gained a reputation for its exceptional service and warm hospitality.
                        Today, Neru Hotel stands as a testament to the enduring legacy of our founder's vision. With 55 years
                        of serving guests from all corners of the world, we continue to uphold our commitment to providing a 
                        welcoming home away from home. Discover a piece of history while indulging in contemporary comforts at 
                        our hotel. We look forward to being a part of your journey and creating cherished memories together.
                    </p>
                </div>
                <div class="col-lg-5 col-md-5 mb-4 order-lg-1 order-md-2 order-1 fade-in-container">
                    <!-- CEO Profile picture -->
                    <img src="Image/rooms/5.jpeg" class="w-100">
                </div>
            </div>
        </div>
        </div>

    <div class="vision">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-5 col-md-5 mb-4 order-lg-1 order-md-1 order-2 fade-in-container">
                    <!-- CEO Profile picture -->
                    <img src="Image/rooms/6.jpeg" class="w-100">
                </div>
                <div class="col-lg-6 col-md-5 order-lg-1 order-md-2 order-1 fade-in-container">
                    <h3 class="mb-3">Our Vision</h3><!--Name-->
                    <p>
                        <!-- description -->
                        At Neru Hotel, our vision is simple yet powerful: to be your premier choice for unforgettable hospitality. 
                        We aspire to create moments of joy, relaxation, and connection for our guests by offering exceptional service, 
                        luxurious accommodations, and memorable experiences. Our commitment is to consistently exceed your expectations, 
                        ensuring that your stay with us is nothing short of extraordinary. Your comfort and satisfaction are at the heart of our vision, 
                        and we eagerly look forward to turning your visit into a cherished memory.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="stuff fade-in-container">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 px-4">
                    <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                        <img src="Image/about/hotel.svg" width="70px">
                        <h4 class="mt-3">100+ ROOMS</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 px-4">
                    <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                        <img src="Image/about/customer.svg" width="70px">
                        <h4 class="mt-3">200+ CUSTOMERS</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 px-4">
                    <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                        <img src="Image/about/rating.svg" width="70px">
                        <h4 class="mt-3">150+ REVIEWS</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 px-4">
                    <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                        <img src="Image/about/stuff.svg" width="70px">
                        <h4 class="mt-3">200+ STUFF</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="team">
    <h3 class="my-5 fw-bold h-font text-center">OUR TEAMS</h3>
    
    <!-- member Profile picture and name-->

    <div class="container px-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper mb-5">
            <?php
                $about_r=selectAll('team_details');
                $path=ABOUT_IMG_PATH;
                while ($row=mysqli_fetch_assoc($about_r)) {
                    echo<<<data
                    <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                        <img src="$path$row[picture]" class="w-100">
                        <h5 class="mt-3">$row[name]</h5>
                    </div>
                    data;
                }
            ?><!--New-->
    </div>

    <?php require('inc/footer.php');?>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            slidesPerView:3,
            spaceBetween: 40,
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
            },
            breakpoints: {
                320:{
                    slidesPerView: 1,
                },
                640:{
                    slidesPerView: 1,
                },
                768:{
                    slidesPerView: 2,
                },
                1024:{
                    slidesPerView: 3,
                },
            }
        });

        document.addEventListener('DOMContentLoaded', function () {

        function isElementInViewport(el) {
            var rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }

        function handleScroll() {
            var elementsToFadeIn = document.querySelectorAll('.fade-in-container');

            elementsToFadeIn.forEach(function (element) {
                if (isElementInViewport(element)) {
                    element.style.opacity = 1;
                    element.style.transform = 'translateY(0)';
                }
            });
        }

        window.addEventListener('scroll', handleScroll);

        handleScroll();
        });

        document.addEventListener('DOMContentLoaded', function () {
        function isElementInViewport(el) {
        var rect = el.getBoundingClientRect();
        return (
            rect.top <= window.innerHeight &&
            rect.bottom >= 0
        );
        }

        function handleScroll() {
        var elementsToFadeIn = document.querySelectorAll('.fade-in-container');

        elementsToFadeIn.forEach(function (element) {
            if (isElementInViewport(element)) {
                element.style.opacity = 1;
                element.style.transform = 'translateY(0)';
            }
        });
        }

        window.addEventListener('scroll', handleScroll);

        handleScroll();
        });
    </script>

</body>
</html>