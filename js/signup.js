var user_name =false;
var user_email =false;
$('#Username').change(()=>{
    user_name =false;
    var user_details = new FormData();  
    user_details.append( 'user_name', $('#Username').val());  
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "user_name_duplicate.php",
        data: user_details,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
            if(result==0){
                $('#Username').val('')
                $('#Username').css("color", "red");
            }else if(result==1){
                $('#Username').css("color", "green");
                user_name =true;
            }else{
                $('#Username').css("color", "red");
            }    
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });
})
$('#Email-Address').change(()=>{
    user_email =false;
    var user_details = new FormData();  
    user_details.append( 'user_email', $('#Email-Address').val());  
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "user_email_duplicate.php",
        data: user_details,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
            if(result==0){
                $('#Email-Address').css("color", "red");
            }else if(result==1){
                $('#Email-Address').css("color", "green");
                user_email =true;
            }else{
                $('#Email-Address').css("color", "red");
            }    
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });
})

$('#email-form').submit(()=>{
    
    if( user_name && user_email){
        // ajax
        var user_details = new FormData();  
        user_details.append( 'firstname', $('#First-Name').val()); 
        user_details.append( 'lastname', $('#Last-Name').val());  
        user_details.append( 'username', $('#Username').val());   
        user_details.append( 'email', $('#Email-Address').val());  
        user_details.append( 'password', $('#Password').val());  
        user_details.append( 'cpassword', $('#Password-2').val());  
        
        let valid = false; 
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "signup.php",
            data: user_details,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function ( result ) {
                if(result==1){
                    valid = true;
                    window.location.href = '../account/myaccount.php';
                }else{
                    alert(result);
                    alert('Error signing up');
                }
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            } 
        });
        return false;
        
    }else{
        if(user_email){
            alert('Invalid username')
            return false;
        }
        if(user_name){
            alert('Invalid email')
            return false;
        }
        return false;
    }

})

$(function() {
    $.ajax({
        type: "GET",
        url: "signed-up.php",
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
            console.log(result);
            if(result==1){
                window.location.href = '../account/myaccount.php';
            }else{
                
            }
            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });
});
