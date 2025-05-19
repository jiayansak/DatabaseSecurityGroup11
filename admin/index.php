<?php
    require('inc/essentials.php');
    require('inc/db_config.php');

    session_start();
    if((isset($_SESSION['adminLogin']) && $_SESSION["adminLogin"]==true)){
        redirect("setting.php");
    }

        $ip = $_SERVER['REMOTE_ADDR'];
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = [];
}

if (!isset($_SESSION['login_attempts'][$ip])) {
    $_SESSION['login_attempts'][$ip] = ['count' => 0, 'start' => time()];
} else {

    if (time() - $_SESSION['login_attempts'][$ip]['start'] < 60 && $_SESSION['login_attempts'][$ip]['count'] >= 5) {
        die("Too many failed attempts. Try again later.");
    } elseif (time() - $_SESSION['login_attempts'][$ip]['start'] >= 60) {
    
        $_SESSION['login_attempts'][$ip] = ['count' => 0, 'start' => time()];
    }
}


if (isset($_POST['login'])) {
    $frm_data = filteration($_POST);

    $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=?";
    $values = [$frm_data['admin_name']];
    $res = select($query, $values, "s");

    if ($res->num_rows == 1) {
        $row = mysqli_fetch_assoc($res);

        if (password_verify($frm_data['admin_pass'], $row['admin_pass'])) {
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminId'] = $row['sr_no'];
            $_SESSION['admin'] = [
                'admin_name' => $row['admin_name'],
                'admin_role' => $row['admin_role']
            ];

            unset($_SESSION['login_attempts'][$ip]);

            redirect('setting.php');
        } else {
           
            $_SESSION['login_attempts'][$ip]['count']++;
            alert('error', 'Login failed - wrong password!');
        }
    } else {
       
        $_SESSION['login_attempts'][$ip]['count']++;
        alert('error', 'Login failed - admin not found!');
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php require('inc/links.php'); ?>
    <style>
        div.login-form{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            width: 400px;
        };
    </style>
</head>
<body class="bg-light" >
    
<div class="login-form text-center rounded bg-white shadow overflow-hidden">
    <form method="POST">
        <h4 class="bg-dark text-white py-3" >ADMIN LOGIN PANEL</h4>
        <div class="p-4">
            <div class="mb-3">
                <input name="admin_name" required type="text" class="form-control shadow-none text-center" placeholder="Admin Name">
            </div>
            <div class="mb-4">
                <input name="admin_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">
            </div>
            <button name="login" type="submit" class="btn text-white custom-bg shadow-none" >LOGIN</button>
        </div>
    </form>
</div>

    <?php

        // if(isset($_POST['login'])) 
        // {
        //      $frm_data = filteration($_POST);
            
        //      $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_pass`=?";

        //      $values = [$frm_data['admin_name'], $frm_data['admin_pass']];

        //      $res = select($query, $values, "ss");
        //       if($res-> num_rows==1)
        //       {
        //         $row=mysqli_fetch_assoc($res);
        //         $_SESSION['adminLogin']= true;
        //         $_SESSION['adminId']=$row['sr_no'];
        //         redirect('setting.php');
        //      }
        //       else{
        //          alert('error','Login failed - invalid Credentials!');
        //       }
        //  }



        //new code ,admin role
        if (isset($_POST['login'])) {
            $frm_data = filteration($_POST);

            // Query by admin_name only
            $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=?";
            $values = [$frm_data['admin_name']];
            $res = select($query, $values, "s");

            if ($res->num_rows == 1) {
                $row = mysqli_fetch_assoc($res);

                // Verify password using hash
                if (password_verify($frm_data['admin_pass'], $row['admin_pass'])) {

                    // ✅ Set session variables (including role)
                    $_SESSION['adminLogin'] = true;
                    $_SESSION['adminId'] = $row['sr_no'];
                    $_SESSION['admin'] = [
                        'admin_name' => $row['admin_name'],
                        'admin_role' => $row['admin_role'] // 👈 CRITICAL FOR ACCESS CONTROL
                    ];

                    redirect('setting.php');
                } else {
                    alert('error', 'Login failed - wrong password!');
                }
            } else {
                alert('error', 'Login failed - admin not found!');
            }
        }

    ?>



    <?php require('inc/script.php'); ?>
</body>
</html>