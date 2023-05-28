
<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        header('location:../account/myaccount.php');
    }else{

      require_once '../tools/functions.php';
      if( isset($_POST['signin']) && isset($_POST['user']) && isset($_POST['password']) && validate_password($_POST['password']) ){
          // validate user
          require_once '../classes/users.class.php';
          $userObj = new users(); 
          if($user_data = $userObj->get_details($_POST['user'])){
            if(password_verify($_POST['password'], $user_data['user_password'])){
              $_SESSION['user_id'] = $user_data['user_id'];
              $_SESSION['user_name'] = $user_data['user_name'];
              $_SESSION['user_firstname'] = $user_data['user_firstname'];
              $_SESSION['user_lastname'] = $user_data['user_lastname'];
              $_SESSION['user_profile'] = $user_data['user_profile'];
              header('location:../account/myaccount.php');
            }
            
          }
          
          
      }else{

      }
    }
?>


