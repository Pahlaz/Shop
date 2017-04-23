(function(){

   // For animating input text fields
   function inputAnimate() {
      var text_val = $(this).val();
    
      if(text_val === "") {
         $(this).removeClass('has-value');
      } 
      else {
         $(this).addClass('has-value');
      }
   }
   $('.input-group input').focusout(inputAnimate);


   var registerBtn = document.querySelector("#register");
   var httpRequest = new XMLHttpRequest();

   registerBtn.onclick = function() {
      if (!httpRequest) {
         alert('Error in making a ajax request');
      }
      else {
         httpRequest.open('POST', 'reg_user.php');
         httpRequest.send();
      }
   }

  
}());