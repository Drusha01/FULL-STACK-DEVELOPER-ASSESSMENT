

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
                                </div>
                                <button class="btn btn-primary" type="button" id="save_user_details">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Flexbox container for aligning the toasts -->
       
           
        

        
    </main>
    
</body>
<script>
$('#save_user_details').click(()=>{
    var user_details = new FormData();  
    user_details.append( 'firstname', $('#firstname').val());  
    user_details.append( 'lastname', $('#lastname').val());  
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "save_details.php",
        data: user_details,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
            // parse result
            if(result!=0){
                user = (JSON.parse(result))
                $('#user_name').html(user.user_name);
                $('#firstname').val(user.user_firstname);
                $('#lastname').val(user.user_lastname);
                $('#profile_img').attr('src','../img/profile/orig/'+user.user_profile);
                $('#thumbnail').attr('src','../img/profile/resized/'+user.user_profile);
                alert('Acount details saved')
            }else{
                alert('Error saving details');
            }
            
            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });
})
let user;
$(function() {
        $.ajax({
        type: "GET",
        url: 'user_details.php',
        success: function(result)
        {
            user = (JSON.parse(result))
            $('#user_name').html(user.user_name);
            $('#firstname').val(user.user_firstname);
            $('#lastname').val(user.user_lastname);
            $('#profile_img').attr('src','../img/profile/orig/'+user.user_profile);
            $('#thumbnail').attr('src','../img/profile/resized/'+user.user_profile);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        }  
    });
});


$(document).ready(function() {
    $('#profilepic').change(function(e) {
        var name = e.target.files[0].name;
        $('#upload-img').html(name.substring(0, 30));
        console.log('changed')

    });
});

$('#save_photo').click(()=>{
    var save_photo = new FormData();
    save_photo.append("profilepic", document.getElementById("profilepic").files[0]);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "save_photo.php",
        data: save_photo,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
            // parse result
            console.log(result)
            if(result!=0){
                user = (JSON.parse(result))
                $('#user_name').html(user.user_name);
                $('#firstname').val(user.user_firstname);
                $('#lastname').val(user.user_lastname);
                $('#profile_img').attr('src','../img/profile/orig/'+user.user_profile);
                $('#thumbnail').attr('src','../img/profile/resized/'+user.user_profile);
                alert('Acount details saved')
            }else{
                alert('Error saving details');
            }
            
            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });
})


</script>