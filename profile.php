<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - PROFILE </title>
</head>
<body class="bg-light">

    <?php 
        require('inc/header.php'); 
        if(!(isset($_SESSION['login']) && $_SESSION['login']==true))
        {
            redirect('index.php');
        }

        $u_exist = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",[$_SESSION['uId']],'s');

        if(mysqli_num_rows($u_exist)==0)
        {
            redirect('index.php');
        }
        $u_fetch = mysqli_fetch_assoc($u_exist);

    ?>

    

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold " >PROFILE</h2>
                <div style="font-size: 14px;" >
                    <a href="index.php" class="text-secondary text-decoration-none" >HOME</a>
                    <span class="text-secondary" > > </span>
                    <a href="#" class="text-secondary text-decoration-none">PROFILE</a>
                </div>
            </div>

            <!-- col-12 -->
            <div class="col-md-4 mb-5 px-4"> 
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id="profile-form" >
                        <h5  class="mb-3 fw-bold">Your Picture</h5>
                        <img src="<?php echo USERS_IMG_PATH.$u_fetch['profile'] ?>" class="img-fluid mb-4 rounded-circle">

                        <label class="form-label">New Picture</label>
                        <input class= "mb-4 form-control shadow-none" type="file" name="profile" accept=".jpg, .jpeg, .png, .webp" required>
                        <button type="submit" class="btn text-white custom-bg mt-3">Save Your picture</button>
                    </form>
                </div>
            </div>


            <div class="col-12 mb-5 px-4"> 
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id="info-form" >
                        <h5  class="mb-3 fw-bold">Basic information</h5>                   
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control shadow-none" value="<?php echo $u_fetch['name'] ?>" required >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="" class="form-label">Phone Number</label>
                                <input type="number" name="phonenum" class="form-control shadow-none" value="<?php echo $u_fetch['phonenum'] ?>" required >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="" class="form-label">Date of birth</label>
                                <input type="date" name="dob" class="form-control shadow-none" value="<?php echo $u_fetch['dob'] ?>" required >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pincode</label>
                                <input name="pincode" type="number" class="form-control shadow-none" value="<?php echo $u_fetch['pincode'] ?>" required>
                            </div>
                            <div class="col-md-8 mb-4">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control shadow-none" rows="1"  required><?php echo $u_fetch['address'] ?></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn text-white custom-bg mt-3">Save Changes</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8 mb-5 px-4"> 
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id="pass-form" >
                        <h5  class="mb-3 fw-bold">Change Password</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">New Password</label>
                                <input name="new_pass" type="password" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Confirm Password</label>
                                <input name="confirm_pass" type="password" class="form-control shadow-none" required>
                            </div>

                        </div>

                        <button type="submit" class="btn text-white custom-bg mt-3">Save Changes</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    


    <?php require('inc/footer.php');?>

    <script>
        //infomation 
        let info_form = document.getElementById('info-form');

        info_form.addEventListener('submit',function(e)
        {
            e.preventDefault();

            let data = new FormData();
            data.append('info_form','');
            data.append('name',info_form.elements['name'].value);
            data.append('phonenum',info_form.elements['phonenum'].value);
            data.append('address',info_form.elements['address'].value);
            data.append('pincode',info_form.elements['pincode'].value);
            data.append('dob',info_form.elements['dob'].value);

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/profile.php",true);

            xhr.onload = function(){
            if(this.responseText =='phone_already'){
                alert('error', "Phone Number has been used");
                }
                else if(this.responseText == 0){
                alert('error', "No Changes!");
                }
                else{
                    alert('success', "Changed!");
                }
            }

        xhr.send(data);

        });


        //picture
        let profile_form = document.getElementById('profile-form');

        profile_form.addEventListener('submit',function(e)
        {
            e.preventDefault();

            let data = new FormData();
            data.append('profile_form','');
            data.append('profile',profile_form.elements['profile'].files[0]);

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/profile.php",true);

            xhr.onload = function()
            {
                if(this.responseText == 'inv_img'){
                        alert('error', "Only JPG, PNG & WEBP are available");
                    }
                    else if(this.responseText == 'upd_failed'){
                        alert('error', "Image upload failed");
                    }
                    
                    else if(this.responseText == 0){
                        alert('error', "Updation failed!");
                    }
                    else{
                        window.location.href = window.location.pathname;
                    }
            }

        xhr.send(data);

        });

        //change password
        let pass_form = document.getElementById('pass-form');

        pass_form.addEventListener('submit',function(e)
        {
            e.preventDefault();

            let new_pass = pass_form.elements['new_pass'].value;
            let confirm_pass = pass_form.elements['confirm_pass'].value;

            if(new_pass != confirm_pass){
                alert('error', 'Password do not match');
                return false;
            }

            let data = new FormData();
            data.append('pass_form','');
            data.append('new_pass',new_pass);
            data.append('confirm_pass',confirm_pass);


            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/profile.php",true);

            xhr.onload = function()
            {
                if(this.responseText == 'mismatch'){
                        alert('error', "Password do not match");
                    }                   
                    else if(this.responseText == 0){
                        alert('error', "Updation failed!");
                    }
                    else{
                        alert('success', 'Changed saved');
                    }
            }

        xhr.send(data);

        });





    </script>

</body>
</html>