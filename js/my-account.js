
$('#save_user_details').click(()=>{
    var user_details = new FormData();  
    user_details.append( 'firstname', $('#firstname').val());  
    user_details.append( 'lastname', $('#lastname').val());  
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "../account/save_details.php",
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
                $('#email').val(user.user_email);
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
        url: '../account/user_details.php',
        success: function(result)
        {
            
            user = (JSON.parse(result))
            console.log(user);
            $('#user_name').html(user.user_name);
            $('#firstname').val(user.user_firstname);
            $('#lastname').val(user.user_lastname);
            $('#email').val(user.user_email);
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
        url: "../account/save_photo.php",
        data: save_photo,
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
                $('#email').val(user.user_email);
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


