$('#email-form').submit(()=>{
    var user_details = new FormData();  
    user_details.append( 'user', $('#Email-Address').val()); 
    user_details.append( 'password', $('#Password').val());
    
    let valid = false; 
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "login.php",
        data: user_details,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
            console.log(result);
            if(result==1){
             
                window.location.href = '../account/myaccount.php';
            }else{
                alert('Error signing up');
                return false;
            }
            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });
    return false;

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