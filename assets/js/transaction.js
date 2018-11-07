(function() {
  	'use strict';

	var httpRequest = new XMLHttpRequest();

	var addTransactionForm = document.querySelector('#add_transaction');
	var delBtn = document.getElementsByClassName('del');
	var editBtn = document.getElementsByClassName('edit');
	var stBtn = document.getElementById('st');
	var transactions = document.getElementById('transactions');
	var entityId = 'transaction';

	// var columnIndex = {
	// 	'name': 1,
	// 	'category': 2,
	// 	'brand': 3,
	// 	'price': 4
	// };
	var transactionDetails = [];


   // if(stBtn){
   // 	stBtn.addEventListener('click', function() {
   // 		let cid = document.getElementById('cid').value;
   // 		let date = document.getElementById('date').value;

   // 		// req('show_transactions.php', showTransactions, "cid="+cid+"&date="+date);
   // 		transactions.src = 'show_transactions.php?cid='+cid+'&date='+date;
   // 		transactions.style.display = 'block';
   // 	});
   // }
 //   function showTransactions() {
	//    if (httpRequest.readyState === XMLHttpRequest.DONE) {
	//     	if (httpRequest.status === 200) { 
	//     		// transactions.innerHTML = httpRequest.responseText;
	//      	} 
	//      	else {
	//         	alert('Can\'t able to show the transactions');
	//       }
	//    }
	// }
















   	// Adding Event Listener to delete buttons
	for (var i = 0; i < delBtn.length; i++) {
		delBtn[i].addEventListener('click', (e) => { deleteRecord(e, entityId) } );
	}


	// Add Event Listener to edit buttons
	for (var i = 0; i < editBtn.length; i++) {
		editBtn[i].addEventListener('click', editBtnClickEvent);
	}
	function editBtnClickEvent(e) {
		var editBtnId = this.parentNode.dataset.id;
		var editInputRow = document.querySelector('.edit-id-'+ editBtnId);

		if(!editInputRow) {
			if (window.confirm("Do you really want to update this record?")) { 
				// document.querySelector('#edit'+editBtnId).parentNode
				var editRow = e.target.parentNode;
				var nodeList = editRow.querySelectorAll("td");

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
				editRow.insertAdjacentHTML('afterend', editInputRowTemplate);

				// setting the reference of editInputRow to the variable (after creating it).
				editInputRow = document.querySelector('.edit-id-'+ editBtnId);

				// Hide the editRow node.
				editRow.style.display = 'none';

				// reference to customerDropdown which is created in editInputRowTemplate.
				var customerDropdown = document.querySelector('.customer-dropdown');
				// reference to updateBtn in editInputRowTemplate.
				var updateBtn = document.querySelector(`.edit-id-${editBtnId} button`);
				var closeBtn = editInputRow.querySelector('.edit-row__close');

				// set event to close button.
				closeBtn.addEventListener('click', () => { closeBtnClickEvent(editInputRow, editRow) });

				// Set event to update button in editInputRowTemplate.
				updateBtn.addEventListener('click', function(e) { updateBtnClickEvent(e, editBtnId, editRow) } );

				// editInputRowCid, editInputRowName, editInputRowAddr variables are defined in page manage_transaction in #add-row (values from database).
				// adding the <options> in customerDropdown.
				for (var i = 0; i < editInputRowCid.length; i++) {
					customerDropdown.insertAdjacentHTML('beforeend', `
						<option value="${editInputRowCid[i]}">${editInputRowName[i]} - ${editInputRowAddr[i]}</option>
					`);
				}

				// selecting the user's previously selected name <option>.
				for(let i = 0; i < customerDropdown.options.length; i++) {
					if(customerDropdown.options[i].value == oldCid) {
						customerDropdown.selectedIndex = customerDropdown.options[i].index;
					}
				}

		   }
		}
	}
	function closeBtnClickEvent(editInputRow, editRow){
		// Remove the editInputRow
		editInputRow.parentNode.removeChild(editInputRow);

		// Show the editRow
		editRow.style.display = 'table-row';
	}
	function updateBtnClickEvent(e, editBtnId, editRow){
		// reference to editInputRow.
		var eir = e.target.parentNode.parentNode;

		// fetching the values from editInputRow.
		var cid = eir.querySelector('select').options[eir.querySelector('select').selectedIndex].value;
		var name = eir.querySelector('select').options[eir.querySelector('select').selectedIndex].text;
		var tdate = eir.querySelector('input[name="tdate"]').value;
		var credit = eir.querySelector('input[name="credit"]').value;
		var debit = eir.querySelector('input[name="debit"]').value;
		var comment = eir.querySelector('input[name="comment"]').value;

		if (!httpRequest) {
	      alert('Error in making a ajax request');
	   }
	   httpRequest.onreadystatechange = function() { updateTransactionRow(editRow, eir) };
	   httpRequest.open('POST', 'edit_record.php');
	   httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	   httpRequest.send('entityId='+entityId+'&cid='+cid+'&tdate='+tdate+'&credit='+credit+'&debit='+debit+'&comment='+comment+'&editBtnId='+editBtnId);
	}
	function updateTransactionRow(editRow, editInputRow) {
	    if (httpRequest.readyState === XMLHttpRequest.DONE) {
	    	if (httpRequest.status === 200) { 
	    		notify(httpRequest.responseText);

				var nodeList = editRow.querySelectorAll("td");

	    		// Reflect the changes to parent element
	    		nodeList[0].innerText = editInputRow.querySelector('select').options[editInputRow.querySelector('select').selectedIndex].text;
				nodeList[1].innerText = editInputRow.querySelector('input[name="tdate"]').value;
				nodeList[2].innerText = editInputRow.querySelector('input[name="credit"]').value;
				nodeList[3].innerText = editInputRow.querySelector('input[name="debit"]').value;
				nodeList[4].innerText = editInputRow.querySelector('input[name="comment"]').value;

				// Display the edited node.
				editRow.style.display = 'table-row';

				// Remove the editing input row
				editInputRow.parentNode.removeChild(editInputRow);
	     	} 
	     	else {
	        	alert('There was a problem editing the record.');
	      }
	    }
	}


	addTransactionForm.addEventListener('submit', function(e) {
		e.preventDefault();

		var cid, name, date, credit, debit, comment;

		cid = document.querySelector('select[name="cid"]').value;
		name = document.querySelector('select[name="cid"]').options[document.querySelector('select[name="cid"]').selectedIndex].text.split('-')[0];
		date = document.querySelector('input[name="date"]').value;
		credit = document.querySelector('input[name="credit"]').value;
		debit = document.querySelector('input[name="debit"]').value;
		comment = document.querySelector('input[name="comment"]').value;

		// send Ajax request to add_customer.php
		if (!httpRequest) {
	   		alert('Error in making a ajax request');
	   	}
	   	httpRequest.onreadystatechange = function() { addTransactionRow(cid, name, date, credit, debit, comment) };
	   	httpRequest.open('POST', 'add_record.php');
	   	httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	   	httpRequest.send('entityId='+entityId+'&cid='+cid+"&date="+date+"&credit="+credit+"&debit="+debit+"&comment="+comment);

	   	this.reset();
	});
	function addTransactionRow(cid, name, date, credit, debit, comment) {
		if (httpRequest.readyState === XMLHttpRequest.DONE) {
	    	if (httpRequest.status === 200) {
	    		let lastRowEl = document.querySelector('#add-row');
	    		let id = httpRequest.responseText;

    			lastRowEl.insertAdjacentHTML('beforebegin', `
	    			<tr data-id="${id}">
						<td data-cid="${cid}">${name}</td>
						<td>${date}</td>
						<td>${credit}</td>
						<td>${debit}</td>
						<td>${comment}</td>
						<td class="btn"> <button class="del" title="Delete"></button> </td>
						<td class="btn"> <button class="edit" title="Edit"></button> </td>
	    			</tr>`);

    			var newRowEL = document.querySelector(`tr[data-id='${id}']`);
	    		let newDelBtn = newRowEL.querySelector('.del');
	    		let newEditBtn = newRowEL.querySelector('.edit');

    			newDelBtn.addEventListener('click', (e) => { deleteRecord(e, entityId) });
				newEditBtn.addEventListener('click', editBtnClickEvent);

				notify('Transaction added successfully');
	     	} else {
	        	notify('There was a problem adding the customer.');
	      }
	   }
	}

})();