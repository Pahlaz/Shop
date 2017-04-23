(function(){
  'use strict'

  ////////////////////////////////////////////
  // AJAX Request
  ////////////////////////////////////////////
  var httpRequest = new XMLHttpRequest();
  var delBtn = document.getElementsByClassName('del');
  var editBtn = document.getElementsByClassName('edit');

  // Add Event Listener to delete buttons
  for (var i = 0; i < delBtn.length; i++) {
    delBtn[i].addEventListener('click', function() {
      var uid = this.id.substring(3);

      if (window.confirm("Do you really want to delete this record?")) { 
        if (!httpRequest) {
          alert('Error in making a ajax request');
        }
        httpRequest.onreadystatechange = delUser;
        httpRequest.open('POST', 'del_user.php');
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send('uid='+uid);
      }
    });
  }
  function delUser() {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) { 
        alert(httpRequest.responseText);
        window.location = "show_users.php"
      } 
      else {
        alert('There was a problem deleting the record.');
      }
    }
  }

})();