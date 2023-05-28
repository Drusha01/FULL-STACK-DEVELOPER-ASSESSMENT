

<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        // header('location:account/myaccount.php');
    }else{
        header('location:../login/login.php');
    }
?>
<?php  require_once '../includes/header.php'?>
<body>
<?php  require_once '../includes/top-nav.php'?>


</body>