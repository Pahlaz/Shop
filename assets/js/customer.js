(function() {
  	'use strict';

	////////////////////////////////////////////
	// AJAX Request
	////////////////////////////////////////////
	var httpRequest = new XMLHttpRequest();
	var delBtn = document.getElementsByClassName('del');
	var editBtn = document.getElementsByClassName('edit');

	// Add Event Listner to delete buttons
	for (var i = 0; i < delBtn.length; i++) {
		delBtn[i].addEventListener('click', function() {
			var btnId = this.id.substring(3);

			if (window.confirm("Do you really want to delete this record?")) { 
				if (!httpRequest) {
			      alert('Error in making a ajax request');
			    }
			    httpRequest.onreadystatechange = delRecord;
			    httpRequest.open('POST', 'del_record.php');
			    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			    httpRequest.send('btnId='+btnId);
			}
		});
	}
	function delRecord() {
	    if (httpRequest.readyState === XMLHttpRequest.DONE) {
	    	if (httpRequest.status === 200) { 
	    		alert(httpRequest.responseText);
	    		window.location = "show_customers.php"
	     	} else {
	        	alert('There was a problem deleting the record.');
	      	}
	    }
	}

	// Add Event Listner to edit buttons
	for (var i = 0; i < editBtn.length; i++) {
		editBtn[i].addEventListener('click', function() {
			var editBtnId = this.id.substring(4);

			if (window.confirm("Do you really want to update this record?")) { 	
				if (!httpRequest) {
			      alert('Error in making a ajax request');
			    }
			    httpRequest.onreadystatechange = editRecord;
			    httpRequest.open('POST', 'edit_customers_form.php');
			    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			    httpRequest.send('editBtnId='+editBtnId);
		   }
		});
	}
	function editRecord() {
	    if (httpRequest.readyState === XMLHttpRequest.DONE) {
	    	if (httpRequest.status === 200) { 
	    		var output = document.querySelector("#output");

	    		output.style.display = 'block';
	    		output.innerHTML = httpRequest.responseText;
	     	} else {
	        	alert('There was a problem editing the record.');
	      	}
	    }
	}

})();