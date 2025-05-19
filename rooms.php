<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - ROOMS </title>
</head>
<style>
    .header {
            margin: 0% auto;
            background: url('Image/rooms/bg.jpg') center/cover no-repeat;
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

    .room-content {
            padding-top: 3%;
            animation: slideIn 1.2s ease forwards;
            width: 100%;
    }
</style>
<body class="bg-light">

    <?php 
        require('inc/header.php'); 

        $checkin_default="";
        $checkout_default="";
        $adult_default="";
        $children_default="";
        if(isset($_GET['check_availability']))
        {
            $frm_data = filteration($_GET);
            $checkin_default=$frm_data['checkin'];
            $checkout_default=$frm_data['checkout'];
            $adult_default=$frm_data['adult'];
            $children_default=$frm_data['children'];
        }
    ?>

    <div class="header">
        <div class="my-5 px-4">
            <h2 class="fw-bold h-font text-center" >ROOMS</h2>
            <p class="text-center mt-3">
            Unwind in the embrace of our thoughtfully designed rooms—where comfort meets style seamlessly.
            </p>
        </div>
    </div>

    <div class="room-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-3 col-md-12 mb-lg-0 md-4 px-4">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow ">
                        <div class="container-fluid flex-lg-column align-items-stretch">
                            <h4 class="mt-2">Filter</h4>
                            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                                <!-- Check availability -->
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size: 18px;">
                                        <span>CHECK AVAILABILITY</span>
                                        <button id="chk_avail_btn" onclick="chk_avail_clear()" class="btn shadow-none  btn-sm text-secondary d-none">Reset</button>
                                    </h5>
                                    <label class="form-label">Check in</label>
                                    <input type="date" class="form-control shadow-none mb-3" value="<?php echo $checkin_default?>" id="checkin" onchange="chk_avail_filter()" >
                                    <label class="form-label">Check out</label>
                                    <input type="date" class="form-control shadow-none" value="<?php echo $checkout_default?>" id="checkout" onchange="chk_avail_filter()">
                                </div>
                                <!-- Facility -->
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size: 18px;">
                                        <span>FACILITIES</span>
                                        <button id="facilities_btn" onclick="facilities_clear()" class="btn shadow-none  btn-sm text-secondary d-none">Reset</button>
                                    </h5>
                                    <?php

                                        $facilities_q = selectAll('facilities');
                                        while($row =mysqli_fetch_assoc($facilities_q))
                                        {
                                            echo<<<facilities
                                            <div class="mb-2">
                                                <input type="checkbox" onclick="fetch_rooms()" name="facilities" value="$row[id]" id="$row[name]" class="form-check-input shadow-none me-1">
                                                <label class="form-check-label" for="$row[id]">$row[name]</label>
                                            </div>
                                            facilities;
                                        }

                                    ?>
                                </div>
                                <!-- Guests -->
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size: 18px;">
                                        <span>GUESTS</span>
                                        <button id="guests_btn" onclick="guests_clear()" class="btn shadow-none  btn-sm text-secondary d-none">Reset</button>
                                    </h5>
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <label class="form-label">Adults</label>
                                            <input type="number" min="1" value="<?php echo $adult_default?>" id="adults" oninput="guests_filter()" class="form-control shadow-none mb-3">
                                        </div>
                                        <div>
                                            <label class="form-label">Children</label>
                                            <input type="number" min="1" value="<?php echo $children_default?>" id="children" oninput="guests_filter()" class="form-control shadow-none mb-3">
                                        </div>
                                    </div>  
                                </div>    
                            </div>
                        </div>
                    </nav>
                </div>

                <div class="col-lg-9 col-md-12 px-4" id="rooms-data" >
                </div>
            </div>
        </div>
    </div>
    
    <script>

        let rooms_data=document.getElementById('rooms-data');
        let checkin =document.getElementById('checkin');
        let checkout =document.getElementById('checkout');
        let chk_avail_btn =document.getElementById('chk_avail_btn');

        let adults = document.getElementById('adults');
        let children = document.getElementById('children');
        let guests_btn = document.getElementById('guests_btn');

        let facilities_btn = document.getElementById('facilities_btn');

        function fetch_rooms()
        {
            let chk_avail = JSON.stringify({
                checkin: checkin.value,
                checkout: checkout.value
            });

            let guests = JSON.stringify({
                adults: adults.value,
                children: children.value
            });

            let facility_list = {"facilities":[]};

            let get_facilities =document.querySelectorAll('[name="facilities"]:checked');
            if(get_facilities.length>0)
            {
                get_facilities.forEach((facility)=>{
                    facility_list.facilities.push(facility.value);
                });
                facilities_btn.classList.remove('d-none');
            }
            else{
                facilities_btn.classList.add('d-none');
            }
            facility_list = JSON.stringify(facility_list);

            let xhr = new XMLHttpRequest();
            xhr.open("GET","ajax/rooms.php?fetch_rooms&chk_avail="+chk_avail+"&guests="+guests+"&facility_list="+facility_list,true);

            xhr.onprogress =function()
            {
                rooms_data.innerHTML='<div class="spinner-border text-info mb-3 d-block mx-auto" id="loader" role="status"><span class="visually-hidden">Loading...</span></div>';
            }

            xhr.onload = function()
            {
                rooms_data.innerHTML = this.responseText;
            }

            xhr.send();
        }


        function chk_avail_filter()
        {
            if(checkin.value!=''&& checkout.value !=''){
                fetch_rooms();
                chk_avail_btn.classList.remove('d-none');
            }
        }

        function chk_avail_clear()
        {
            checkin.value='';
            checkout.value='';
            fetch_rooms();
            chk_avail_btn.classList.add('d-none');
        }

        function guests_filter()
        {
            if(adults.value>0 || children.value>0)
            {
                fetch_rooms();
                guests_btn.classList.remove('d-none');
            }
        }

        function guests_clear()
        {
            adults.value='';
            children.value='';
            guests_btn.classList.add('d-none');
            fetch_rooms();
            
        }

        function facilities_clear()
        {
            let get_facilities =document.querySelectorAll('[name="facilities"]:checked');
            get_facilities.forEach((facility)=>{
                facility.checked=false;
            });
            facilities_btn.classList.add('d-none');
            fetch_rooms();
            
        }

        window.onload =function()
        {
            fetch_rooms();
        }

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
    


    <?php require('inc/footer.php');?>

</body>
</html>