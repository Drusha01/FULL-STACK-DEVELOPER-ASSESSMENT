let user;
$(function() {
    $.ajax({
        type: "GET",
        url: '../account/user_details.php',
        success: function(result)
        {
            user = (JSON.parse(result))
            // $('#user_name').html(user.user_name);
            // $('#firstname').val(user.user_firstname);
            // $('#lastname').val(user.user_lastname);
            // $('#email').val(user.user_email);
            // $('#profile_img').attr('src','../img/profile/orig/'+user.user_profile);
            
            $('#my_name').html(user.user_firstname +' '+user.user_lastname).text();
            $('#thumbnail').attr('src','../img/profile/resized/'+user.user_profile);
            $('#profile-img').attr('src','../img/profile/resized/'+user.user_profile);
            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        }  
    });
});


$('#addcontact').click(()=>{
    console.log('nice')
})
