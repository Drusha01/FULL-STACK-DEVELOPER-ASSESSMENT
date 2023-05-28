<?php 

    session_start();
    if(!isset($_SESSION['user_id'])){
        if(isset($_POST['user_name']) && strlen($_POST['user_name'])>=5 && isset($_SESSION['temp_user_name']) && $_SESSION['temp_user_name'] != $_POST['user_name']){
            $_SESSION['temp_user_name'] = $_POST['user_name'];
            if(preg_match('/^[a-zA-Z0-9]{6,}$/',$_SESSION['temp_user_name'])) {
                require_once '../classes/users.class.php';
                $userObj = new users(); 
                $user_name = $_POST['user_name'];

                if($user_data = $userObj->user_name_duplicate($_SESSION['temp_user_name'])){
                    print_r($user_data);
                }else{
                    echo 1;
                    $_SESSION['temp_user_name_valid'] = true;
                }
            }
        }else if(isset($_POST['user_name']) && strlen($_POST['user_name'])>=5){
            $_SESSION['temp_user_name'] = $_POST['user_name'];
            if(preg_match('/^[a-zA-Z0-9]{6,}$/',$_SESSION['temp_user_name'])) {
                require_once '../classes/users.class.php';
                $userObj = new users(); 
                $user_name = $_POST['user_name'];

                if($user_data = $userObj->user_name_duplicate($_SESSION['temp_user_name'])){
                    print_r($user_data);
                }else{
                    echo 1;
                    $_SESSION['temp_user_name_valid'] = true;
                }
            }
        }else{
            echo '0';
        }
    }
?>