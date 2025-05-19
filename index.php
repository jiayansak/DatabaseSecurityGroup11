<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?>-HOME</title>
    <style>
        .custom-alert{
            position: fixed;
            top: 100px;
            right: 25px;
            z-index: 1111;
        }
        .availability-form{
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }

        @media screen and (max-width: 575px){
            .availability-form{
                margin-top: 25px;
                padding: 0 35px;
            }
        }

        .container {
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 1.5s ease, transform 2.0s ease;
        }

        .facilities .col-lg-2:hover{
            transform: scale(1.03);
            transition: all 0.3s;
        }

        @keyframes slideIn {
        from {
            transform: translateY(100px);
        }
        to {
            transform: translateY(0);
        }
        }

    </style>
</head>
<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <!-- Cover-->

    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <?php
                    $res = selectAll('carousel');

                    while($row = mysqli_fetch_assoc($res))
                    {
                        $path = CAROUSEL_IMG_PATH;
                        echo <<<data
                        <div class="swiper-slide">
                            <img src="$path$row[image]" class="w-100 d-block" />
                        </div>
                        data;
                    }
                ?><!--New-->
            </div>
        </div>
    </div>
            

    <!-- check avaibility form -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-4">Check Booking Avaibility</h5>
                <form action="rooms.php">
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight:500;">Check in</label>
                            <input type="date" class="form-control shadow-none" name="checkin" required >
                        </div>
                        <div class="col-lg-3  mb-3">
                            <label class="form-label" style="font-weight:500;">Check out</label>
                            <input type="date" class="form-control shadow-none" name="checkout" required >
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight:500;" >Adult</label>
                            <select class="form-select shadow-none" name="adult"> 
                                <?php
                                    $guests_q =mysqli_query($con,"SELECT MAX(adult) AS `max_adult`,MAX(children) AS `max_children` FROM `rooms` WHERE `status`='1' AND `removed`='0'");
                                    $guests_res = mysqli_fetch_assoc($guests_q);

                                    for($i=1;$i<=$guests_res['max_adult'];$i++)
                                    {
                                        echo"<option value='$i'>$i</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight:500;">Children</label>
                            <select class="form-select shadow-none" name="children" >
                            <?php
                                for($i=1;$i<=$guests_res['max_children'];$i++)
                                {
                                    echo"<option value='$i'>$i</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <input type="hidden"name="check_availability">
                        <div class="col-lg-1 mb-lg-3 mt-2 ">
                            <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Rooms -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Rooms</h2>

    <!-- Room Container -->
    <div class="container">
        <div class="row">

        <?php
                $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3",[1,0],'ii');

                while ($room_data = mysqli_fetch_assoc($room_res)) 
                {
                    //get features 
                    $fea_q= mysqli_query($con,"SELECT f.name FROM `features` f 
                        INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                        WHERE rfea.room_id = '$room_data[id]'");

                    $features_data="";
                    while ($fea_row = mysqli_fetch_assoc($fea_q))
                    {
                        $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                            $fea_row[name]
                        </span>";

                    }

                    //get facilities

                    $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f 
                    INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
                    WHERE rfac.room_id = '$room_data[id]'");

                    $facilities_data = "";

                    while ($fac_row = mysqli_fetch_assoc($fac_q))
                    {
                        $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                            $fac_row[name]
                        </span>";

                    }

                    //get thumbnail image
                    $room_thumb = ROOMS_IMG_PATH."1.jpg";
                    $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` 
                    WHERE `room_id` = '$room_data[id]' 
                    AND `thumb` = '1'");

                    if(mysqli_num_rows($thumb_q)>0)
                    {
                        $thumb_res = mysqli_fetch_assoc($thumb_q);
                        $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
                    }

                    $book_btn="";

                    if(!$settings_r['shutdown'])
                    {
                        $login=0; 
                        if(isset($_SESSION['login'])&&$_SESSION['login']==true)
                        {
                            $login=1;
                        }
                        $book_btn ="<button onclick='checkLoginToBook($login,$room_data[id])'  class='btn btn-sm text-white custom-bg shadow-none'>Book Now</button>";
                    }

                    //print room card

                    echo <<< data
                        <div class="col-lg-4 col-md-6 my-3">
                            <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
                                <img src="$room_thumb" class="card-img-top">
                                <div class="card-body">
                                    <h5>$room_data[name]</h5>
                                    <h6 class="mb-4">RM$room_data[price]</h6>
                                    <div class="features mb-4">
                                        <h6 class="mb1">Features</h6>
                                        $features_data
                                    </div>
                                    <div class="facilities mb-4">
                                        <h6 class="mb1">Facilities</h6>
                                        $facilities_data
                                    </div>
                                    <div class="guest mb-4">
                                        <h6 class="mb1">Guest</h6>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            $room_data[adult] Adults
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            $room_data[children] Children
                                        </span>
                                    </div>
                                    <div class="rating mb-4">
                                        <h6 class="mb1">Rating</h6>
                                        <span class="badge rounded-pill bg-light">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-evenly mb-2">
                                        $book_btn
                                        <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none">View Room</a>
                                    </div>
                                </div>            
                            </div>
                        </div>
                    data;
                }
            ?>
            

            <div class="col-lg-12 text-center mt-5">
                <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms</a>
            </div>
        </div>
    </div>

    <!-- Facilities -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Facilities</h2>
    
    <div class="facilities">
        <div class="container">
            <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
                <?php
                    $res = mysqli_query($con,"SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 5");
                    $path = FACILITIES_IMG_PATH;

                    while ($row = mysqli_fetch_assoc($res)) {
                        echo<<<data
                            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                                <img src="$path$row[icon]" width="50px">
                                <h5 class="mt-3">$row[name]</h5>
                            </div>
                        data;
                    }
                ?>
                <div class="col-lg-12 text-center mt-5">
                    <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonial -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TESTIMONIAL</h2>

    <div class="container mt-5">
        <div class="swiper swiper-testimonial">
            <div class="swiper-wrapper mb-5">

              <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-3">
                    <img src="Image/features/T1.jpg" width="30px">
                    <h6 class="m-0 ms-2">Jason Carter</h6>
                </div>
                <p>
                    A fantastic stay! The staff was incredibly friendly and accommodating. 
                    The facilities were modern and well-maintained. The location was convenient, 
                    and the overall atmosphere was welcoming. Definitely a five-star experience!"
                </p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
              </div>

              <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-3">
                    <img src="Image/features/T2.jpg" width="30px">
                    <h6 class="m-0 ms-2">Olivia Patel</h6>
                </div>
                <p>
                    Outstanding hotel! From the warm welcome at the reception to the beautifully appointed rooms,
                    every aspect exceeded our expectations. The attention to customer satisfaction is evident, 
                    and we can't wait to return. Highly recommended!
                </p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
              </div>

              <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-3">
                    <img src="Image/features/T3.jpg" width="30px">
                    <h6 class="m-0 ms-2">Emma Rodriguez</h6>
                </div>
                <p>
                    Exceptional service and attention to detail! 
                    The staff went above and beyond to make our stay memorable. 
                    The amenities were top-notch, and the cleanliness was impeccable. 
                    A truly delightful experience!
                </p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
              </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="col-lg-12 text-center mt-5">
            <a href="aboutus.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Know More</a>
        </div>
    </div>

    <!-- Contact Us -->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">CONTACT Us</h2>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                <iframe class="w-100 rounded" height="320" src="<?php echo $contact_r['iframe']?>"  loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div><!--New-->
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Contact Us</h5>
                    <a href="tel: +<?php echo $contact_r['pn1']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone"></i>+<?php echo $contact_r['pn1']?>
                    </a><!--New-->
                    <br>
                    <?php
                        if($contact_r['pn2']!== ''){
                            echo<<<data
                            <a href="tel: +$contact_r[pn2]" class="d-inline-block mb-2 text-decoration-none text-dark">
                                <i class="bi bi-telephone"></i>+$contact_r[pn2]
                            </a>
                            data;
                        }
                    ?><!--New-->
                    
                </div>
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Follow Us</h5>
                    <?php
                        if($contact_r['tw']!= ''){
                            echo<<<data
                            <a href="$contact_r[tw]" class="d-inline-block mb-3 ">
                                <span class="badge bg-light text-dark fs-6 p-2">
                                    <i class="bi bi-twitter-x me-1"></i>Twitter
                                </span>
                            </a>
                            <br>
                            data;
                        }
                    ?><!--New-->
                    
                    <a href="<?php echo $contact_r['insta']?>" class="d-inline-block mb-3 ">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-instagram me-1"></i>Instagram
                        </span>
                    </a><!--New-->
                    <br>
                    <a href="<?php echo $contact_r['fb']?>" class="d-inline-block mb-3 ">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-facebook me-1"></i>Facebook
                        </span>
                    </a><!--New-->
                </div>
            </div>
        </div>
    </div>

    <!-- Reset Password -->

    <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="recovery-form" >
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-shield-lock fs-3 me-2"></i> Set up New Password
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <label class="form-label">New Password</label>
                            <input type="password" name="pass" required class="form-control shadow-none">
                            <input type="hidden" name="email">
                            <input type="hidden" name="token">
                        </div>
                        <div class="mb-2 text-end">
                            <button type="button" class="btn shadow-none me-2" data-bs-dismiss="modal">
                                CANCEL
                            </button>
                            <button type="submit" class="btn btn-dark shadow-none">SUBMIT</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


<?php require('inc/footer.php');?>

<?php 
    if(isset($_GET['account_recovery']))
    {
        $data= filteration($_GET);

        $t_date = date("Y-m-d");

        $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND`token`=? AND `t_expire`=? LIMIT 1",[$data['email'],$data['token'],$t_date],'sss');

        if(mysqli_num_rows($query)==1)
        {
            echo<<<showModal
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var myModal = new bootstrap.Modal(document.getElementById('recoveryModal'));

                    myModal.show();

                    var emailInput = document.querySelector("input[name='email']");
                    var tokenInput = document.querySelector("input[name='token']");

                    emailInput.value ='$data[email]';
                    tokenInput.value ='$data[token]';
                });
            </script>
            showModal;
        }
        else{
            alert("error","Invalid or Expired Link !");
        }
    }
 ?>

    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            effect: "fade",
            loop:true,
            autoplay:{
                delay: 3500,
                disableOnInteraction: false,
            }
        });

        var swiper = new Swiper(".swiper-testimonial", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
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

        // recovery content
        let recovery_form = document.getElementById('recovery-form');

        recovery_form.addEventListener('submit',(e)=>{
            e.preventDefault();

            let data = new FormData();

            data.append('email',recovery_form.elements['email'].value);
            data.append('token',recovery_form.elements['token'].value);
            data.append('pass',recovery_form.elements['pass'].value);
            data.append('recover_user','');

            var myModal = document.getElementById('recoveryModal');
            var modal = bootstrap.Modal.getInstance(myModal);  
            modal.hide();

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/login_register.php", true);


            xhr.onload = function(){
                if(this.responseText == 'failed'){
                    alert('error', "Account reset failed.");
                }
                else
                {
                    alert('success', "Account reset successfully");
                    recovery_form.reset();
                }
                
            }
            
            xhr.send(data); 

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
    var elementsToFadeIn = document.querySelectorAll('.container');

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
var elementsToFadeIn = document.querySelectorAll('.container');

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