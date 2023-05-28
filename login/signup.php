<?php 
    session_start();
    
    if(isset($_SESSION['user_id'])){
        echo '0';
        return;
    }else{
       
        if( isset($_POST['username']) && isset($_POST['password'])  && isset($_POST['email']) && isset($_POST['cpassword']) && isset($_POST['firstname']) &&  isset($_POST['lastname'])){
            // validate user
            
            require_once '../tools/functions.php';
            $_POST['username'] = trim($_POST['username']);
            $_POST['password'] = trim($_POST['password']);
            $_POST['cpassword'] = trim($_POST['cpassword']);
            $_POST['firstname'] = trim($_POST['firstname']);
            $_POST['lastname'] = trim($_POST['lastname']);
            if(strlen($_POST['username'])>=6  && strlen($_POST['cpassword']>=8) && $_SESSION['temp_user_name_valid'] && $_SESSION['temp_user_name'] == $_POST['username'] && ($_POST['cpassword'] == $_POST['password']) 
            && $_SESSION['temp_user_email_valid'] && $_SESSION['temp_user_email'] == $_POST['email'] && strlen($_POST['firstname']>=0) && strlen($_POST['lastname']>=0) && validate_password($_POST['password'])){
                if(preg_match('/^[a-zA-Z0-9]{6,}$/',$_POST['username'])) {
                    require_once '../classes/users.class.php';
                    $userObj = new users();
                    if(!$user_data = $userObj->get_details($_POST['username'])){
                        $_POST['password'] = password_hash($_POST['password'], PASSWORD_ARGON2I);
                        if($userObj->insert($_POST['username'],$_POST['email'],$_POST['password'],$_POST['firstname'],$_POST['lastname'])){
                            // set session
                            if($user_data = $userObj->get_details($_POST['username'])){
                                $_SESSION['user_id'] = $user_data['user_id'];
                                $_SESSION['user_name_verified'] = $user_data['user_name_verified'];
                                $_SESSION['user_email_verified'] = $user_data['user_email_verified'];
                                $_SESSION['user_name'] = $user_data['user_name'];
                                $_SESSION['user_email'] = $user_data['user_email'];
                                $_SESSION['user_firstname'] = $user_data['user_firstname'];
                                $_SESSION['user_lastname'] = $user_data['user_lastname'];
                                $_SESSION['user_profile'] = $user_data['user_profile'];
                                
                                echo '1';
                                return;
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
                if($_POST['firstname']<0){
                    echo 'Invalid firstname';
                    return;
                }
                if($_POST['lastname']<0){
                    echo 'Invalid lastname';
                    return;
                }
                if(!$_SESSION['temp_user_email_valid']){
                    echo  'Invalid email';
                    return;
                }
                if($_POST['cpassword'] != $_POST['password']){
                    echo  'Invalid confirm password';
                    return;
                }
            }
        }else{
            $error ='Invalid credentials';
        }
    }
    if($error){
        echo $error;
    }
    
?>



