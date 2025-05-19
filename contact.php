<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - Contact Us </title>
    <style>
        .header {
            margin: 0% auto;
            background: url('Image/rooms/2.jpeg') center/cover no-repeat;
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

        .container {
            padding-top: 3%;
            animation: slideIn 1.2s ease forwards;
            width: 100%;
        }

        .my-5 > .fw-bold, .h-line {
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
            transform: translateY(20px);
            transition: opacity 1.5s ease, transform 1.0s ease;
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
            <h2 class="fw-bold h-font text-center" >CONTACT US</h2>
            <p class="text-center mt-3">
            Connect with Us: Your Gateway to Exceptional Service and Assistance.
            </p>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <iframe class="w-100 rounded mb-4" height="320" src="<?php echo $contact_r['iframe']?>"></iframe><!--New-->
                    
                    <h5>Address</h5>
                    <a href="<?php echo $contact_r['gmap']?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt-fill"></i> <?php echo $contact_r['address']?>
                    </a><!--New-->

                    <h5 class="mt-4">Call Us</h5>
                    <a href="tel: +<?php echo $contact_r['pn1']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone"></i>+<?php echo $contact_r['pn1']?>
                    </a><!--New-->
                    <br>
                    <?php
                        if($contact_r['pn2']!=''){
                            echo<<<data
                            <a href="tel: +$contact_r[pn2]" class="d-inline-block mb-2 text-decoration-none text-dark">
                                <i class="bi bi-telephone"></i>+$contact_r[pn2]
                            </a>
                            data;
                        }
                    ?><!--New-->

                    <h5 class="mt-4">Email</h5>
                    <a href="mailto: <?php echo $contact_r['email']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-envelope-at-fill"></i> <?php echo $contact_r['email']?>
                    </a><!--New-->

                    <h5 class="mt-4">Follow Us</h5>
                    <?php
                        if($contact_r['tw']!= ''){
                            echo<<<data
                            <a href="$contact_r[tw]" class="d-inline-block text-dark fs-5 me-2">
                                <i class="bi bi-twitter-x me-1"></i>
                            </a>
                            data;
                        }
                    ?><!--New-->
                    <a href="<?php echo $contact_r['insta']?>" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-instagram me-1"></i>
                    </a><!--New-->
                    <a href="<?php echo $contact_r['fb']?>" class="d-inline-block text-dark fs-5 ">
                        <i class="bi bi-facebook me-1"></i>
                    </a><!--New-->
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form method="POST">
                        <h5>Send a message</h5>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input name="name" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Email</label>
                            <input name="email" required type="email" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Subject</label>
                            <input name="subject" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Message</label>
                            <textarea name="message" required class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
                        </div>
                        <button type="submit" name="send" class="btn text-white custom-bg mt-3">SEND</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if(isset($_POST['send']) )
    {
        $frm_data = filteration($_POST);

        $q="INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $values = [$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message'],];

        $res = insert($q,$values,'ssss');
        if($res==1){
            alert('success','Mail sent!');
        }
        else{
            alert('error','Error! Please try again later');
        }
    }
    ?>


<?php require('inc/footer.php');?>
<script>
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