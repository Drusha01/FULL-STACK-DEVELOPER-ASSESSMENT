

<?php 
    $pageTitle = 'Profile';
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


    
    <main>
        <div class="container-xl px-4 mt-4">
            <hr class="mt-0 mb-4">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card mb-4 mb-xl-0">
                        
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <img class="img-account-profile rounded-circle mb-2" src="../img/default.png" id="profile_img" class="rounded-circle" width="150">
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <button class="btn btn-primary" type="button" id="upload-img" onclick="$('#profilepic').click();">Upload new image</button>
                            <input type="file" class="form-control-file" id="profilepic" name="profilepic" accept="image/*" style="visibility: hidden;" >
                            <button class="btn btn-primary" type="button" id="save_photo">Save photo</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <div id="user_name">Username</div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="firstname" >First name</label>
                                        <input class="form-control" id="firstname" type="text" placeholder="Enter your first name" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="lastname">Last name</label>
                                        <input class="form-control" id="lastname"  id="lastname" type="text" placeholder="Enter your last name" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="email" >Email</label>
                                        <input class="form-control" id="email" type="text" placeholder="Enter your email" value="">
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="button" id="save_user_details">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Flexbox container for aligning the toasts -->
       
           
        

    <script src="../js/my-account.js" type="text/javascript"></script>
    </main>
</body>
