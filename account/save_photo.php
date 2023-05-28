<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';

// check if we are logged in
if(isset($_SESSION['user_id'])){

    $userObj = new users;
    
    
    $profile_pic = false;
    // check the profile picture file upload
    if (isset($_FILES['profilepic'])) {
        
        $type = array('png', 'bmp', 'jpg');
        $size = (1024 * 1024) * 5; // 2 mb
        if (validate_file($_FILES, 'profilepic', $type, $size)) {
            $profilepic_dir = dirname(__DIR__, 1) . '/img/profile/';
            // check if the folder exist  
            if(!is_dir($profilepic_dir)){
                // create directory
                mkdir($profilepic_dir);
            }
            $extension = getFileExtensionfromFilename($_FILES['profilepic']['name']);
            $filename = md5($_FILES['profilepic']['name']);
            $counter = 0;
            // only move if the filename is unique
            while(file_exists($profilepic_dir.$filename.'.jpg')){
                $counter++;
                $filename = md5($_FILES['profilepic']['name'].$counter);
            }
            switch($extension){
                case 'png':
                    $img = imagecreatefrompng($_FILES['profilepic']['tmp_name']);
                    // convert jpeg
                    imagejpeg($img,$profilepic_dir.$filename.'.jpg',100);
                    break;
                case 'bmp':
                    $img = imagecreatefrompng($_FILES['profilepic']['tmp_name']);
                    // convert jpeg
                    imagejpeg($img,$profilepic_dir.$filename.'.jpg',100);
                    break;
                case 'jpg':
                    move_uploaded_file($_FILES['profilepic']['tmp_name'], $profilepic_dir.$filename.'.jpg');
                    break;
            }
        
            $img_file_name =($filename.'.jpg');
        
            $profile_resize_dir = dirname(__DIR__, 1) . '/img/profile/orig/';
            $profile_thumbnail_dir = dirname(__DIR__, 1) . '/img/profile/resized/';
            // check if the profile-resize folder exist
            if(!is_dir($profile_resize_dir)){
                // create directory
                mkdir($profile_resize_dir);
            }
            // check if the resize folder thumbnail
            if(!is_dir($profile_thumbnail_dir)){
                // create directory
                mkdir($profile_thumbnail_dir);
            }
            // resize file
        
            // profile display
            $result = resizeImage($profilepic_dir,$profile_resize_dir,$filename.'.jpg',$filename,80,500,500);
            if($result){
                //echo 'error resize 500x500 <br>';
            }
            // thumbnail
            $result = resizeImage($profilepic_dir,$profile_thumbnail_dir,$filename.'.jpg',$filename,80,150,150);
            if($result){
                //echo 'error resize 150x150 <br>';
            }
            $profile_pic = true;
        }
    }

    
    if($profile_pic){
        // update data in database
        if($userObj->update_user_profile_photo($_SESSION['user_id'],$img_file_name)){
            
            // delete the old file
            if ( $_SESSION['user_profile'] != 'default.png' && unlink($profilepic_dir . $_SESSION['user_profile']) && 
                unlink($profile_resize_dir . $_SESSION['user_profile']) && unlink($profile_thumbnail_dir . $_SESSION['user_profile'])) {
                $_SESSION['user_profile'] = $img_file_name;
                echo (json_encode($_SESSION));
            }else{
                $_SESSION['user_profile'] = $img_file_name;
                echo (json_encode($_SESSION)); 
            }
            
        }else{
            echo '0';
        }
    }    
} else {
  // go to login page
  header('location:../login/login.php');
}


?>




