<?php
    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['get_bookings']))
    {
        $query = "SELECT * FROM `bookings` ORDER BY `id` DESC";
        $res= mysqli_query($con, $query);
        $i=1;
        $table_data="";

        while ($data=mysqli_fetch_assoc($res)) 
        {   
                          
            $table_data.="
                <tr>
                    <td>$i</td>
                    <td>$data[user_name]</td>
                    <td>$data[room_no]</td>
                    <td>$data[room_type]</td>
                    <td>$data[checkin_date]</td>
                    <td>$data[checkout_date]</td>
                    <td>RM $data[total_payment]</td>
                    <td>$data[payment_status]</td>
                    <td>$data[booking_status]</td>
                    <td>
                        <button type='button' onclick='assign_room($data[id])' class='btn text-white btn-sm fw-bold custom-bg shadow-none' data-bs-toggle='modal' data-bs-target='#assign-room'>
                        <i class='bi bi-check2-square'></i>Assign Room
                        </button>
                        <br>
                        <button type='button' onclick='cancel_booking($data[id])' class='mt-2 btn btn-outline-danger btn-sm fw-bold shadow-none'>
                        <i class='bi bi-trash'></i>Cancel Booking
                        </button>
                    </td>
                </tr>
            ";
            $i++;
        }
        echo $table_data;
    }

    if(isset($_POST['assign_room']))
    {
       $frm_data = filteration($_POST);

       $query = "UPDATE `bookings` SET booking_status = ?, room_no = ? WHERE id = ?";
       $values =['booked',$frm_data['room_no'],$frm_data['id']];
       $res = update($query,$values,'ssi');

       echo ($res);
    }

    if(isset($_POST['cancel_booking']))
    {
       $frm_data = filteration($_POST);

       $query = "UPDATE `bookings` SET booking_status = ?, room_no = ? WHERE id = ?";
       $values =['cancelled','not assigned',$frm_data['id']];
       $res = update($query,$values,'ssi');

       echo ($res);
    }

    if(isset($_POST['search_user']))
    {
        $frm_data = filteration($_POST);

        $query = "SELECT * FROM `user_cred` WHERE `name` LIKE ?";

        $res =  select($query,["%$frm_data[name]%"],'s');
        $i=1;
        $path = USERS_IMG_PATH;


        $data="";
        while($row = mysqli_fetch_assoc($res))
        {
            $del_btn="<button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none btn-sm'>
                <i class='bi bi-trash'></i> 
            </button>";

            $verified="<span class='badge bg-warning '><i class='bi bi-x-lg'></i></span>";

            if($row['is_verified'])
            {
                $verified="<span class='badge bg-success '><i class='bi bi-check-lg'></i></span>";
            }

            $status="<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>Active</button>";

            if(!$row['status']){
                $status="<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'>Inactive</button>";
            }

            $date = date("d-m-Y",strtotime($row['datentime']));

            $data.="
                <tr>
                    <td>$i</td>
                    <td>
                    <img src='$path$row[profile]' width='55px'>
                    <br>
                    $row[name]
                    </td>
                    <td>$row[email]</td>
                    <td>$row[phonenum]</td>
                    <td>$row[address] | $row[pincode]</td>
                    <td>$row[dob]</td>
                    <td>$verified</td>
                    <td>$status</td>
                    <td>$date</td>
                    <td>$del_btn</td>
                </tr>
            ";
            $i++;
        }

        echo $data;
    }
?>