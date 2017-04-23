(function() {
  	'use strict';

   	var httpRequest = new XMLHttpRequest();
   	var delBtn = document.getElementsByClassName('del');
   	var editBtn = document.getElementsByClassName('edit');
   	var stBtn = document.getElementById('st')
   	var transactions = document.getElementById('transactions');
	
	////////////////////////////////////////////
   	// AJAX Request
   	////////////////////////////////////////////
   	
   	function req(url, funName, param) {
   		if (!httpRequest) {
	      alert('Error in making a ajax request');
	    }
	    httpRequest.onreadystatechange = funName;
	    httpRequest.open('POST', url);
	    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	    httpRequest.send(param);
   	}

   	if(stBtn){
   	stBtn.addEventListener('click', function() {
   		let cid = document.getElementById('cid').value;
   		let date = document.getElementById('date').value;

   		req('show_transactions.php', showTransactions, "cid="+cid+"&date="+date);
   		transactions.src = 'show_transactions.php';
   		transactions.style.display = 'block';
   	});
   	}
   	function showTransactions() {
	    if (httpRequest.readyState === XMLHttpRequest.DONE) {
	    	if (httpRequest.status === 200) { 
	    		// transactions.innerHTML = httpRequest.responseText;
	     	} else {
	        	alert('Can\'t able to show the transactions');
	      	}
	    }
	}

   	// Adding Event Listner to delete buttons
	for (var i = 0; i < delBtn.length; i++) {
		delBtn[i].addEventListener('click', function() {
			var btnId = this.id.substring(3);

			if (window.confirm("Do you really want to delete this record?")) { 
				req('del_t_rec.php', delRecord, 'btnId='+btnId);
			}
		});
	}
	function delRecord() {
	    if (httpRequest.readyState === XMLHttpRequest.DONE) {
	    	if (httpRequest.status === 200) { 
	    		alert(httpRequest.responseText);
	    		window.location = "show_transactions.php"
	     	} else {
	        	alert('There was a problem deleting the record.');
	      	}
	    }
	}

	// Add Event Listner to edit buttons
	// for (var i = 0; i < editBtn.length; i++) {
	// 	editBtn[i].addEventListener('click', function() {
	// 		var editId = this.id.substring(3);
	
	// 		alert('editing');
	// 		if (!httpRequest) {
	// 	      alert('Error in making a ajax request');
	// 	    }
	// 	    // httpRequest.onreadystatechange = editRecord;
	// 	    // httpRequest.open('POST', 'edit_record.php');
	// 	    // httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	// 	    // httpRequest.send('btnId='+btnId);
		
	// 	});
	// }
	// function editRecord() {
	//     if (httpRequest.readyState === XMLHttpRequest.DONE) {
	//     	if (httpRequest.status === 200) { 
	//     		alert(httpRequest.responseText);
	//     		window.location = "show_customers.php"
	//      	} else {
	//         	alert('There was a problem deleting the record.');
	//       	}
	//     }
	// }
})();