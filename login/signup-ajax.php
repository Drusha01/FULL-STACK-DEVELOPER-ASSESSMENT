<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        header('location:../account/myaccunt.php');
    }else{
        print_r($_POST);
        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstame']) &&  isset($_POST['lastname'])){
            
        }
    }
?>