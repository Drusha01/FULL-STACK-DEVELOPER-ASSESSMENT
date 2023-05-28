

<?php 
    $pageTitle = 'Message';
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


    <div class="h-100 d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary" style="width: 380px; " >
        <a href="#" class="d-flex align-items-center flex-shrink-0 p-3 link-body-emphasis text-decoration-none border-bottom">
        <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-5 fw-semibold">List group</span>
        </a>

        <div style="overflow-y: scroll;">
            <div>
                <a href="#" onclick="activeChat(1)" class="list-group-item list-group-item-action py-3 lh-sm" id="message-1" aria-current="true" style="background-color: rgba(220, 220, 220, 0.8);" >
                    <img class="img-account-profile rounded-circle mb-2" width="60px" height="60px" src="../img/default.png" alt="" >
                    <span class="position-absolute mt-2 ml-3 ">
                        <strong>Hanrickson Dumapit</strong>
                        <br>
                        <small class="position-absolute mt-1">How is it going</small>
                    </span>
                </a>
            </div>
            <div >
                <a href="#" onclick="activeChat(2)" class="list-group-item list-group-item-action  py-3 lh-sm" id="message-2" aria-current="true" style="background-color:white;">
                    <img class="img-account-profile rounded-circle mb-2" width="60px" height="60px" src="../img/default.png" alt="" >
                    <span class="position-absolute mt-2 ml-3 ">
                        <strong>Hanrickson Dumapit</strong>
                        <br>
                        <small class="position-absolute mt-1">How is it going</small>
                    </span>
                </a>
            </div>
            <div >
                <a href="#" onclick="activeChat(3)" class="list-group-item list-group-item-action  py-3 lh-sm" id="message-3" aria-current="true"  style="background-color:white;">
                    <img class="img-account-profile rounded-circle mb-2" width="60px" height="60px" src="../img/default.png" alt="" >
                    <span class="position-absolute mt-2 ml-3 ">
                        <strong>Hanrickson Dumapit</strong>
                        <br>
                        <small class="position-absolute mt-1">How is it going</small>
                    </span>
                </a>
            </div>
            <div >
                <a href="#" onclick="activeChat(4)" class="list-group-item list-group-item-action  py-3 lh-sm" id="message-4" aria-current="true"  style="background-color:white;">
                    <img class="img-account-profile rounded-circle mb-2" width="60px" height="60px" src="../img/default.png" alt="" >
                    <span class="position-absolute mt-2 ml-3 ">
                        <strong>Hanrickson Dumapit</strong>
                        <br>
                        <small class="position-absolute mt-1">How is it going</small>
                    </span>
                </a>
            </div>
            <div >
                <a href="#" onclick="activeChat(5)" class="list-group-item list-group-item-action  py-3 lh-sm" id="message-5" aria-current="true" >
                    <img class="img-account-profile rounded-circle mb-2" width="60px" height="60px" src="../img/default.png" alt="" >
                    <span class="position-absolute mt-2 ml-3 ">
                        <strong>Hanrickson Dumapit</strong>
                        <br>
                        <small class="position-absolute mt-1">How is it going</small>
                    </span>
                </a>
            </div>
            <div >
                <a href="#" onclick="activeChat(6)" class="list-group-item list-group-item-action  py-3 lh-sm" id="message-6" aria-current="true" >
                    <img class="img-account-profile rounded-circle mb-2" width="60px" height="60px" src="../img/default.png" alt="" >
                    <span class="position-absolute mt-2 ml-3 ">
                        <strong>Hanrickson Dumapit</strong>
                        <br>
                        <small class="position-absolute mt-1">How is it going</small>
                    </span>
                </a>
            </div>

            <div >
                <a href="#" onclick="activeChat(7)" class="list-group-item list-group-item-action  py-3 lh-sm" id="message-7" aria-current="true" >
                    <img class="img-account-profile rounded-circle mb-2" width="60px" height="60px" src="../img/default.png" alt="" >
                    <span class="position-absolute mt-2 ml-3 ">
                        <strong>Hanrickson Dumapit</strong>
                        <br>
                        <small class="position-absolute mt-1">How is it going</small>
                    </span>
                </a>
            </div>
            
            
        </div>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4 position-fixed mt-5" style="z-">
        <div class="w-100 bg-primary">
        <h5 class="col-12 fw-bold mb-3">Accounts</h5>
        </div>
    </main>


</body>

<script>
let user;
$(function() {
        $.ajax({
        type: "GET",
        url: '../account/user_details.php',
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

var active =1;
function activeChat(id){
    $('#message-'+active).css('background-color','white')
    $('#message-'+id).css('background-color','rgba(220, 220, 220, 0.8)')
    active = id;
console.log(id)
    
}

</script>
