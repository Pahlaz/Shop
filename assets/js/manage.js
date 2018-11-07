(function() {
  	'use strict';

  	// entityId is a variable defined in pages.
	var httpRequest = new XMLHttpRequest();
	var notifyEl = document.querySelector('.notify');

	var delBtn = document.getElementsByClassName('del');
	var editBtn = document.getElementsByClassName('edit');

	if(entityId == "customer") {
		var addCustomerForm = document.querySelector('#add_customer');
	}
	else if(entityId == "transaction") {
		var addTransactionForm = document.querySelector('#add_transaction');
		var stBtn = document.getElementById('st');
		var transactions = document.getElementById('transactions');
	}

	function notify(message) {
		// Notifying the message.
		notifyEl.querySelector('.notify__msg').textContent = message;
		notifyEl.style.display = 'block';

		// Automatically hiding the notification after 4 seconds.
		setTimeout(() => {
			notifyEl.style.display = 'none';
			// remove the message.
			notifyEl.querySelector('.notify__msg').textContent = "";
		}, 4000);
	}
	// For hiding the notification.
	notifyEl.querySelector('.notify__close-btn').addEventListener('click', () => {
		notifyEl.style.display = 'none';
	});



	function deleteRecord(id) {
	    if (httpRequest.readyState === XMLHttpRequest.DONE) {
	    	if (httpRequest.status === 200) {
				// remove the row form DOM
	    		document.querySelector("tr[data-id='"+id+"']").parentNode.removeChild(document.querySelector("tr[data-id='"+id+"']"));

	    		// Notifying the message.
	    		notify(httpRequest.responseText);
	     	} 
	     	else {
	     		// Notifying the message.
	     		notify('There was a problem deleting the '+entityId+'.');
	      	}
	    }
	}
	function deleteBtnClickEvent() {
		// 'this' refer to the delete button on which we clicked
		var id = this.parentNode.dataset.id;

		if (window.confirm("Do you really want to delete this "+entityId+"?")) {
			if (!httpRequest) {
		      alert('Error in making a ajax request');
		    }
		    httpRequest.onreadystatechange = function() { deleteRecord(id) };
		    httpRequest.open('POST', 'del_record.php');
		    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    httpRequest.send('entityId='+entityId+'&id='+id);
		}
	}
	// Adding Event Listener to delete buttons
	for (var i = 0; i < delBtn.length; i++) {
		delBtn[i].addEventListener('click', deleteBtnClickEvent);
	}



	function updateCustomerRow(editingRow, editInputRow) {
	    if (httpRequest.readyState === XMLHttpRequest.DONE) {
	    	if (httpRequest.status === 200) { 
				var nodeList = editingRow.querySelectorAll("td");
	    		// Reflect the changes to editingRow.
	    		nodeList[0].innerText = editInputRow.querySelector('input[name="name"]').value;
				nodeList[1].innerText = editInputRow.querySelector('input[name="addr"]').value;
				nodeList[2].innerText = editInputRow.querySelector('input[name="city"]').value;
				nodeList[3].innerText = editInputRow.querySelector('input[name="phno"]').value;

				// Display the edit node.
				editingRow.style.display = 'table-row';

				// Remove the editing input row
				editInputRow.parentNode.removeChild(editInputRow);

				// Notifying the message.
	    		notify(httpRequest.responseText);
	     	} 
	     	else {
	     		// Notifying the message.
	    		notify('There was a problem deleting the record.');
	      	}
	    }
	}
	function updateBtnClickEvent(editInputRow, editingRow){
		var editBtnId = editingRow.dataset.id;

		// fetching the updated values of editingRow.
		var name = editInputRow.querySelector('input[name="name"]').value;
		var addr = editInputRow.querySelector('input[name="addr"]').value;
		var city = editInputRow.querySelector('input[name="city"]').value;
		var phno = editInputRow.querySelector('input[name="phno"]').value;

		if (!httpRequest) {
	      alert('Error in making a ajax request');
	   	}
	   	httpRequest.onreadystatechange = function() { updateCustomerRow(editingRow, editInputRow) };
	   	httpRequest.open('POST', 'edit_record.php');
	   	httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	   	httpRequest.send('entityId=customer'+'&name='+name+'&addr='+addr+'&city='+city+'&phno='+phno+'&editBtnId='+editBtnId);
	}
	function editBtnClickEvent() {
		var editingRow = this.parentNode;
		var editBtnId = editingRow.dataset.id;
		var editInputRow = document.querySelector('.edit-id-'+ editBtnId);

		// for not adding more than one editing row.
		if(!editInputRow) {
			if (window.confirm("Do you really want to update this "+entityId+"?")) { 
				var nodeList = editingRow.querySelectorAll("td");

				if(entityId == "customer") {
					// initializing the values.
					var oldName = nodeList[0].innerText;
					var oldAddr = nodeList[1].innerText;
					var oldCity = nodeList[2].innerText;
					var oldPhno = nodeList[3].innerText;

					// Inserting editInputRow in DOM and adding old values in it.
					editingRow.insertAdjacentHTML('afterend', `
			    		<tr id="edit-row" class="edit-id-${editBtnId}">
							<td><input type="text" name="name" value="${oldName}"></td>
							<td><input type="text" name="addr" value="${oldAddr}"></td>
							<td><input type="text" name="city" value="${oldCity}"></td>
							<td><input type="number" name="phno" value="${oldPhno}"></td>
							
							<td class="btn edit-btn"><button type="button">Update</button></td>
							<td class="btn edit-row__close" title="Close"> <img src="assets/img/delete.png" alt="close"> </td>
						</tr>`);
				}
				else if(entityId == "transaction") {
					// values in the columns of editRow.
					var oldCid = nodeList[0].dataset.cid;
					var oldName = nodeList[0].innerText;
					var oldTDate = nodeList[1].innerText;
					var oldCredit = nodeList[2].innerText;
					var oldDebit = nodeList[3].innerText;
					var oldComment = nodeList[4].innerText;

					var editInputRowTemplate = `
			    		<tr id="edit-row" class="edit-id-${editBtnId}">
							<td> <select class="customer-dropdown"> <option value="#">Select a Customer</option> </select> </td>
							<td> <input type="date" name="tdate" value="${oldTDate}" required> </td>
							<td> <input type="number" name="credit" value="${oldCredit}"> </td>
							<td> <input type="number" name="debit" value="${oldDebit}"> </td>
							<td> <input type="text" name="comment" value="${oldComment}"> </td>
							<td class="btn edit-btn" title="Update"> <button type="button">Update</button> </td>
							<td class="btn edit-row__close" title="Close"> <img src="assets/img/delete.png" alt="close"> </td>
						</tr>`;

					// adding editInputRowTemplate to DOM.
					editingRow.insertAdjacentHTML('afterend', editInputRowTemplate);
				}
				

				// setting the reference of edit-row to the variable.
				editInputRow = document.querySelector('.edit-id-'+ editBtnId);

				// Hide the editing node.
				editingRow.style.display = 'none';

				// reference to update button in editInputRow.
				var updateBtn = editInputRow.querySelector('button');

				// Set event to update button.
				updateBtn.addEventListener('click', function() { updateBtnClickEvent(editInputRow, editingRow) } );
		   }
		}
	}
	// Add Event Listener to edit buttons
	for (var i = 0; i < editBtn.length; i++) {
		editBtn[i].addEventListener('click', editBtnClickEvent);
	}