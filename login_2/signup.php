<?php 
    session_start();
    
    if(isset($_SESSION['user_id'])){
        header('location:../account/myaccount.php');
    }else{
        if( isset($_POST['username']) && isset($_POST['password'])  && isset($_POST['cpassword']) && isset($_POST['firstname']) &&  isset($_POST['lastname'])){
            // validate user
            require_once '../tools/functions.php';
            $_POST['username'] = trim($_POST['username']);
            $_POST['password'] = trim($_POST['password']);
            $_POST['cpassword'] = trim($_POST['cpassword']);
            $_POST['firstname'] = trim($_POST['firstname']);
            $_POST['lastname'] = trim($_POST['lastname']);
            if(strlen($_POST['username'])>=6  && strlen($_POST['cpassword']>=8) && ($_POST['cpassword'] == $_POST['password']) && strlen($_POST['firstname']>=0) && strlen($_POST['lastname']>=0) && validate_password($_POST['password'])){
                if(preg_match('/^[a-zA-Z0-9]{6,}$/',$_POST['username'])) {
                    require_once '../classes/users.class.php';
                    $userObj = new users();
                    if(!$user_data = $userObj->get_details($_POST['username'])){
                        $_POST['password'] = password_hash($_POST['password'], PASSWORD_ARGON2I);
                        if($userObj->insert($_POST['username'],$_POST['password'],$_POST['firstname'],$_POST['lastname'])){
                            // set session
                            if($user_data = $userObj->get_details($_POST['username'])){
                                $_SESSION['user_id'] = $user_data['user_id'];
                                $_SESSION['user_name'] = $user_data['user_name'];
                                $_SESSION['user_firstname'] = $user_data['user_firstname'];
                                $_SESSION['user_lastname'] = $user_data['user_lastname'];
                                $_SESSION['user_profile'] = $user_data['user_profile'];
                                header('location:../account/myaccount.php');
                            }else{
                                $error ='Error sign up';
                            }
                        }else{
                            $error ='Error sign up';
                        }

                    }else{
                        $error ='Username taken';
                    }
                }else{
                    $error ='Invalid username';
                }
            }else{
                $error ='Invalid credentials';
            }
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
                            <h3 class="text-center text-info">Signup</h3>
                            <div class="form-group">
                                <label for="password" class="text-info">Firstname:</label><br>
                                <input type="text" name="firstname" id="firstname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Lastname:</label><br>
                                <input type="text" name="lastname" id="lastname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control" minlength="6" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control" minlength="8" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Confirm password:</label><br>
                                <input type="password" name="cpassword" id="cpassword" class="form-control" minlength="8" required>
                            </div>
                           
                            <?php if(isset($error)){echo '
                            <div class="alert alert-danger" role="alert">
                            '.$error.'
                            </div>';}?>
                            

                            <div class="form-group">
                                <button class="btn btn-lg btn-info btn-block" type="submit" name="signup" id="signup">Sign up</button>
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="login.php" class="text-info">Login?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>    
    // $('#signup').click(
    //     //console.log('nice')
    // )
</script>





