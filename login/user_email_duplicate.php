<?php 

    session_start();
    if(!isset($_SESSION['user_id'])){
        if(isset($_POST['user_email']) && strlen($_POST['user_email'])>=5 && isset($_SESSION['temp_user_email']) && $_SESSION['temp_user_email'] != $_POST['user_email']){
            $_SESSION['temp_user_email'] = $_POST['user_email'];
            if($_POST['user_email'] = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL)) {
                require_once '../classes/users.class.php';
                $userObj = new users(); 
                $user_email = $_POST['user_email'];

                if($user_data = $userObj->user_email_duplicate($_SESSION['temp_user_email'])){
                    print_r($user_data);
                }else{
                    echo 1;
                    $_SESSION['temp_user_email_valid'] = true;
                }
            }
        }else if(isset($_POST['user_email']) && strlen($_POST['user_email'])>=5){
            $_SESSION['temp_user_email'] = $_POST['user_email'];
            if($_POST['user_email'] = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL)) {
                require_once '../classes/users.class.php';
                $userObj = new users(); 
                $user_email = $_POST['user_email'];

                if($user_data = $userObj->user_email_duplicate($_SESSION['temp_user_email'])){
                    print_r($user_data);
                }else{
                    echo 1;
                    $_SESSION['temp_user_email_valid'] = true;
                }
            }
        }else{
            echo '0';
        }
    }
?>