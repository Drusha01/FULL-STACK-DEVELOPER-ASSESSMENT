

<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        echo (json_encode($_SESSION));
    }else{
        header('location:../login/login.php');
    }
?>