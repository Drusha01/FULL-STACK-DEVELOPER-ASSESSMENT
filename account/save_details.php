<?php 
session_start();
if(isset($_SESSION['user_id'])){
    if( isset($_POST['firstname']) && strlen($_POST['firstname'])>0 &&  isset($_POST['lastname']) && strlen($_POST['lastname'])>0){
        // validate user
        $_POST['firstname'] = trim($_POST['firstname']);
        $_POST['lastname'] = trim($_POST['lastname']);
        require_once '../classes/users.class.php';
        $userObj = new users(); 
        if($userObj->update_user_details($_SESSION['user_id'],$_POST['firstname'],$_POST['lastname'])){
            $_SESSION['user_firstname'] = $_POST['firstname'];
            $_SESSION['user_lastname'] = $_POST['lastname'];
            echo (json_encode($_SESSION));
        }else{
            echo '0';
        }
    }else{
        echo '0';
    }
}else{
    header('location:../login/login.php');
}

?>