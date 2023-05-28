
<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        header('location:../account/myaccount.php');
    }else{

      require_once '../tools/functions.php';
      if( isset($_POST['signin']) && isset($_POST['username']) && isset($_POST['password']) && validate_password($_POST['password']) ){
          // validate user
        print_r($_POST);
          if(preg_match('/^[a-zA-Z0-9]{6,}$/',$_POST['username'])) {
            require_once '../classes/users.class.php';
            $userObj = new users(); 
            if($user_data = $userObj->get_details($_POST['username'])){
              if(password_verify($_POST['password'], $user_data['user_password'])){
                $_SESSION['user_id'] = $user_data['user_id'];
                $_SESSION['user_name'] = $user_data['user_name'];
                $_SESSION['user_firstname'] = $$user_data['user_firstname'];
                $_SESSION['user_lastname'] = $user_data['user_lastname'];
                $_SESSION['user_photo'] = $user_data['user_photo'];
                header('location:../account/myaccount.php');
              }
              
            }
          }
          
      }else{

      }
    }
?>


<?php  require_once '../includes/header.php'?>

<body>
    <div id="login">
      <h3 class="text-center text-white pt-5">Login form</h3>
      <div class="container">
          <div id="login-row" class="row justify-content-center align-items-center">
              <div id="login-column" class="col-md-6">
                  <div id="login-box" class="col-md-12">
                      <form id="login-form" class="form" action="" method="post">
                          <h3 class="text-center text-info">Login</h3>
                          <div class="form-group">
                              <label for="username" class="text-info">Username:</label><br>
                              <input type="text" name="username" id="username" class="form-control" required>
                          </div>
                          <div class="form-group">
                              <label for="password" class="text-info">Password:</label><br>
                              <input type="password" name="password" id="password" class="form-control" required>
                          </div>
                          <?php if(isset($error)){echo '
                            <div class="alert alert-danger" role="alert">
                            '.$error.'
                            </div>';}?>
                          <div class="form-group">
                              <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                              <button class="btn btn-lg btn-info btn-block" type="submit" name="signin">Sign in</button>
                          </div>
                          <div id="register-link" class="text-right">
                              <a href="signup.php" class="text-info">Register here</a>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
</body>





