<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        header('location:account/myaccount.php');
    }else{
        header('location:login/login.html');
    }
?>