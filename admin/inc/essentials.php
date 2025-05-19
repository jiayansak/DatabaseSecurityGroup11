<?php

    //forntend purpose data

    define('SITE_URL','https://127.0.0.1/DatabaseSecurity1/');
    define('ABOUT_IMG_PATH',SITE_URL.'Image/about/');
    define('CAROUSEL_IMG_PATH',SITE_URL.'Image/carousel/');
    define('FACILITIES_IMG_PATH',SITE_URL.'Image/facilities/');
    define('ROOMS_IMG_PATH',SITE_URL.'Image/rooms/');
    define('USERS_IMG_PATH',SITE_URL.'Image/users/');



    //backend upload process data

    define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/DatabaseSecurity1/Image/');
    define('ABOUT_FOLDER','about/');
    define('CAROUSEL_FOLDER','carousel/');
    define('FACILITIES_FOLDER','facilities/');
    define('ROOMS_FOLDER','rooms/');
    define('USERS_FOLDER','users/');

    //sendgrid api key
    define('SENDGRID_API_KEY',"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");
    define('SENDGRID_EMAIL',"seowjuinwei@gmail.com");
    define('SENDGRID_NAME',"JWEI");

    function adminLogin(){
        session_start();
        if(!(isset($_SESSION['adminLogin']) && $_SESSION["adminLogin"]==true)){
            echo"<script>
                window.location.href='index.php';
            </script>";
            exit;
        }
    }

    function redirect($url){
        echo"<script>
                window.location.href='$url';
            </script>";
            exit;
    }

    function alert($type,$msg) {
        $bs_class= ($type =="success") ? "alert-success": "alert-danger";

        echo <<<alert
            <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
                <strong class="me-3" >$msg</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        alert;
    }

    function uploadImage($image,$folder)
    {
        $valid_mime = ['image/jpeg','image/png','image/webp'];
        $img_mime = $image['type'];

        if(!in_array($img_mime, $valid_mime)){
            return 'inv_img'; //invalid image mime or format
        }
        else if(($image['size']/(1024*1024))>5){
            return 'inv_size'; //invalid size greater than 2mb
        }
        else{
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $rname = 'IMG'.random_int(11111,99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'], $img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        };
            
    }

    
    function deleteImage($image, $folder)
    {
        $imagePath = UPLOAD_IMAGE_PATH . $folder . $image;
        if (unlink($imagePath)) {
            return true;
        } else {
            error_log("Failed to delete image: $imagePath");
            return false;
        }
    }


    function uploadSVGImage($image,$folder)
    {
        $valid_mime = ['image/svg+xml'];//MIME type for SVG
        $img_mime = $image['type'];

        if(!in_array($img_mime, $valid_mime)){
            return 'inv_img'; //invalid image mime or format
        }
        else if(($image['size']/(1024*1024))>1){
            return 'inv_size'; //invalid size greater than 1mb
        }
        else{
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $rname = 'IMG'.random_int(11111,99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'], $img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        };
            
    }

    function uploadUserImage($image)
    {
        $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
        $img_mime = $image['type'];

        if (!in_array($img_mime, $valid_mime)) {
            return 'inv_img'; // invalid image mime or format
        } else {
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $rname = 'IMG' . random_int(11111, 99999) . '.jpeg';

            $img_path = UPLOAD_IMAGE_PATH . USERS_FOLDER . $rname;

            $img_data = file_get_contents($image['tmp_name']);
            $img = imagecreatefromstring($img_data);

            if ($ext == 'png' || $ext == 'PNG') {
                $img = imagecreatefrompng($image['tmp_name']);
            } else if ($ext == 'webp' || $ext == 'WEBP') {
                $img = imagecreatefromwebp($image['tmp_name']);
            } else {
                // Use imagecreatefromstring() for JPEG
                $img_data = file_get_contents($image['tmp_name']);
                $img = imagecreatefromstring($img_data);
            }

            if (imagejpeg($img, $img_path, 75)) {
                return $rname;
            } else {
                return 'upd_failed';
            }
        }
    }

    //daily record 
    function log_action($message, $type = 'INFO') {
    $log_file = realpath(__DIR__ . '/../logs/system.log');
    
    // fallback if realpath fails
    if (!$log_file) {
        $log_file = __DIR__ . '/../logs/system.log';
    }

    $date = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

    $log_entry = "[$date][$type][$ip] $message" . PHP_EOL;
    file_put_contents($log_file, $log_entry, FILE_APPEND);
}





    

?>