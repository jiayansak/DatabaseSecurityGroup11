<?php
    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    

    // if(isset($_POST['add_admin'])) {
    //     $frm_data = filteration($_POST);
    //     $flag = 0;
    //     $path = USERS_IMG_PATH;

    //     // Handle file upload
    //     $img = uploadUserImage($from_data['profile']);

    //     if($img == 'inv_img'){
    //         echo 'inv_img';
    //         exit;
    //     }
    //     else if($img == 'upd_failed'){
    //         echo 'upd_failed';
    //         exit;
    //     }
    //     $hashed_pass = password_hash($frm_data['pass'], PASSWORD_BCRYPT);
        

    //     $q1 = "INSERT INTO `admin_cred`(`admin_name`, `admin_pass`) 
    //             VALUES (?, ?)";
    //     $values = [$frm_data['name'], $frm_data['pass']];
        
    //     if(insert($q1, $values, 'ssssss')) 
    //     {
    //         $flag = 1;
    //     }             
    //     if ($flag) {
    //         // Hash the password before storing it
    //         echo 1;
            
    //     } else {
    //         echo 0;
    //     }
    // }

    if(isset($_POST['get_admin']))
    {
        $res =  selectAll('admin_cred');
        $i=1;
        // $path = USERS_IMG_PATH;


        $data="";
        while($row = mysqli_fetch_assoc($res))
        {
            $del_btn="<button type='button' onclick='remove_admin($row[sr_no])' class='btn btn-danger shadow-none btn-sm'>
                <i class='bi bi-trash'></i> 
            </button>";

            
            // $verified="<span class='badge bg-warning '><i class='bi bi-x-lg'></i></span>";

            // if($row['is_verified'])
            // {
            //     $verified="<span class='badge bg-success '><i class='bi bi-check-lg'></i></span>";
            // }

            // $status="<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>Active</button>";

            // if(!$row['status']){
            //     $status="<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'>Inactive</button>";
            // }

            // $date = date("d-m-Y",strtotime($row['datentime']));

            $data.="
                <tr>
                    <td>$i</td>
                    <td>$row[admin_name]</td>
                    <td>{$row['admin_role']}</td>
                    <td>$del_btn</td>
                </tr>
            ";
            $i++;
        }

        echo $data;
    }
    
    

    if(isset($_POST['toggle_status']))
    {
        $frm_data = filteration($_POST);

        $q="UPDATE `user_cred` SET `status`=? WHERE `id`=?";
        $v = [$frm_data['value'],$frm_data['toggle_status']];

        if(update($q,$v,'ii'))
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }

    if(isset($_POST['change_status']))
    {
        $frm_data = filteration($_POST);

        $q="UPDATE `user_cred` SET `status`=? WHERE `id`=?";
        $v = [$frm_data['value'],$frm_data['change_status']];

        if(update($q,$v,'ii'))
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }

    if (isset($_POST['remove_admin'])) {
        $frm_data = filteration($_POST);
    
        // Remove the condition 'AND is_verified=0' to allow deletion irrespective of verification status
        $res = delete("DELETE FROM `admin_cred` WHERE `sr_no`=?", [$frm_data['sr_no']], 'i');
    
        if ($res) {
            //new daily
            log_action("Admin '{$_SESSION['admin']['admin_name']}' deleted admin with sr_no: {$frm_data['sr_no']}", 'DELETE');
            echo 1;
        } else {
            echo 0;
        }
    }


    if(isset($_POST['search_admin']))
    {
        $frm_data = filteration($_POST);

        $query = "SELECT * FROM `admin_cred` WHERE `admin_name` LIKE ?";

        $res =  select($query,["%$frm_data[name]%"],'s');
        $i=1;


        $data="";
        while($row = mysqli_fetch_assoc($res))
        {
            $del_btn="<button type='button' onclick='remove_admin($row[sr_no])' class='btn btn-danger shadow-none btn-sm'>
                <i class='bi bi-trash'></i> 
            </button>";

            // $verified="<span class='badge bg-warning '><i class='bi bi-x-lg'></i></span>";

            // if($row['is_verified'])
            // {
            //     $verified="<span class='badge bg-success '><i class='bi bi-check-lg'></i></span>";
            // }

            // $status="<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>Active</button>";

            // if(!$row['status']){
            //     $status="<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'>Inactive</button>";
            // }

            // $date = date("d-m-Y",strtotime($row['datentime']));

            $data.="
                <tr>
                    <td>$i</td>
                    <td>$row[admin_name]</td>
                    <td>{$row['admin_role']}</td>
                    <td>$del_btn</td>
                </tr>
            ";
            $i++;
        }

        echo $data;
    }
?>