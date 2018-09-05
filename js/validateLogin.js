$(document).ready(function() 
{
   
   
	$("#email").focus(function(){
        $("#email").next("span").remove();
        $("#Login").next("span").remove();
        $("#email").removeClass("ok");
        $("#email").removeClass("error");
          
});

    
    $("#email").blur(function(){
        $("#email").next("span").remove();
        var e = $("#email").val();
        
        if(e.match(/^.([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)){
            $("#email").removeClass("error");
            $("#email").addClass("ok");
        }
        
        else if(e=="")
            {    $("#email").next("span").remove();
                 $("#Login").next("span").remove();
                 $(this).addClass("error"); 
                 $("#email").after('<span class="info">Please enter your email</span>');
              
                
            }
        
        
        else{
        $("#email").addClass("error");
        }
    
});
    
   $("#password").focus(function(){
        $("#password").next("span").remove();
        $("#Login").next("span").remove();
        $("#password").removeClass("ok");
        $("#password").removeClass("error");
          
});
    
    $("#password").blur(function(){
        $("#password").next("span").remove();
        var p = $("#password").val();
        if(p.match(/^.{8,}/)){
            $("#password").removeClass("error");
            $("#password").addClass("ok");
                
                    
        }
        
        else if(p=="")
            {    $("#password").next("span").remove();
                 $("#Login").next("span").remove();
                 $(this).addClass("error"); 
                 $("#password").after('<span class="info">Please enter your password</span>');
              
                
            }
        
        else{
        $("#password").addClass("error");
       
        }
    
});
   
    
$("#Login").click(function() {
var email = $("#email").val();
var password = $("#password").val();
if (email == '' || password == '') {
     $("#email").next("span").remove();
    $("#password").next("span").remove(); 
    $("#Login").next("span").remove();
    $("#Login").after('<span class="info">All fields are mandatory</span>');
    //event.preventDefault();            
} 
 });
});
    
  

