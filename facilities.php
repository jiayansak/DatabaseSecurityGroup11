<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - Facilities </title>
    <style>
        .header {
            margin: 0% auto;
            background: url('Image/rooms/3.jpeg') center/cover no-repeat;
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

        .container {
            padding: 10% 0%;
        }

        .pop:hover{
            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
        .faq{
            font-family: 'Times New Roman', Times, serif;
            background-color: white; 
        }

        .faq-header{
            font-size: 60px;
            text-align: center;
            padding: 5% 5% 2% 5%;
        }

        .content{
            text-align: left;
            padding: 10px 55px 50px;
        }

        .question {
            padding: 20px 0;
            border-bottom: 1px dotted #ccc;
        }

        .panel-question {
            font-size: 24px;
            width: 100%;
            position: relative;
            margin: 0;
            padding: 10px 10px 0 48px;
            display: block;
            cursor: pointer;
        }

        .panel-answer {
            font-size: 20px;
            padding: 0px 14px;
            margin: 0 30px;
            height: 0;
            overflow: hidden;
            z-index: -1;
            position: relative;
            opacity: 0;
            transition: .4s ease;
        }

        .panel:checked ~ .panel-answer{
            height: auto;
            opacity: 1;
            padding: 3%;
        }

        .panel {
            display: none;
        } 

        .fade-in-container {
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 1.2s ease, transform 2.0s ease;
        }

        .fade-in-text {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1.5s ease, transform 2.0s ease;
        }
    </style>
</head>
<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="header">
        <div class="my-5 px-4">
            <h2 class="fw-bold h-font text-center" >Facilities</h2>
            <div class="h-line bg-dark"></div>
            <p class="text-center mt-3">
                    Discover Comfort and Convenience: Our Exceptional Facilities Await You.
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php
                $res = selectAll('facilities');
                $path = FACILITIES_IMG_PATH;

                while ($row = mysqli_fetch_assoc($res)) {
                    echo<<<data
                        <div class="col-lg-4 col-md-6 mb-5 px-4">
                            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="$path$row[icon]" width="40px">
                                    <h5 class="m-0 ms-3">$row[name]</h5>
                                </div>
                                <p>
                                    $row[description]
                                </p>
                            </div>
                        </div>
                    data;
                }
            ?>
        </div>
    </div>

    <div class="faq">
        <div class="faq-header fade-in-container">
            <h2>Frequently Asked Questions</h2>
        </div>
        <div class="content fade-in-container">
            <div class="question">
                <input id="q1" type="checkbox" class="panel">
                <label for="q1" class="panel-question">What are the check-in and check-out times?</label>
                <div class="panel-answer">Check-in time is at 2:00 PM, and check-out time is at 11:00 AM.</div>
            </div>
            <div class="question">
                <input id="q2" type="checkbox" class="panel">
                <label for="q2" class="panel-question">Is parking available on-site?</label>
                <div class="panel-answer">Yes, we provide on-site parking for our guests. There may be a daily parking fee, which is outlined in our pricing.</div>
            </div>
            <div class="question">
                <input id="q3" type="checkbox" class="panel">
                <label for="q3" class="panel-question">Can all guests access the gym, and is there an additional cost?</label>
                <div class="panel-answer">The gym is available to all guests, and there is no additional cost. Enjoy staying active during your visit!</div>
            </div>
            <div class="question">
                <input id="q4" type="checkbox" class="panel">
                <label for="q4" class="panel-question">How can I request room service?</label>
                <div class="panel-answer">Room service is available during specific hours. You can place your order by calling the front desk or using the in-room dining menu.</div>
            </div>
            <div class="question">
                <input id="q5" type="checkbox" class="panel">
                <label for="q5" class="panel-question">How can I request special facilities for physically challenged guests?</label>
                <div class="panel-answer">The business center is open during specific hours; feel free to inquire at the front desk for the exact schedule.</div>
            </div>
            <div class="question">
                <input id="q6" type="checkbox" class="panel">
                <label for="q6" class="panel-question">What are the operating hours of the business center?</label>
                <div class="panel-answer">If you have specific accessibility needs, please contact our staff, and we'll be happy to assist in making your stay comfortable.</div>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php');?>

<script>
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
</script>
</body>
</html>