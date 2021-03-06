(function() {
  	'use strict';

	var httpRequest = new XMLHttpRequest();

	var addCustomerForm = document.querySelector('#add_customer');
	var entityId = 'customer';
	var customerDetails = [];
	var columnIndex = {
		'name': 1,
		'address': 2,
		'city': 3,
		'phone no.': 4
	};


	// For loading content in UI.
	function loadData(data) {
		let contentFirstEl = document.querySelector('.content').firstElementChild;

		// Reversing the data, so that it gets loaded in correct order in UI.
		data = data.reverse();

		for(var d of data) {
			contentFirstEl.insertAdjacentHTML('afterend', `
	    			<tr data-id="${d[0]}">
						<td> ${capitalize(d[1])} </td>
						<td> ${capitalize(d[2])} </td>
						<td> ${capitalize(d[3])} </td>
						<td> ${d[4]} </td>
						<td class="btn"> <button class="del" title="Delete"></button> </td>
						<td class="btn"> <button class="edit" title="Edit"></button> </td>
	    			</tr>`);
		}

		let delBtn = document.querySelectorAll('.del');
		let editBtn = document.querySelectorAll('.edit');

		// Add Event Listener to delete buttons
		for (let i = 0; i < delBtn.length; i++) {
			delBtn[i].addEventListener('click', (e) => { deleteRecord(e, entityId) } );
		}

		// Add Event Listener to edit buttons
		for (let i = 0; i < editBtn.length; i++) {
			editBtn[i].addEventListener('click', editBtnClickEvent);
		}
	}
	
	// request to fetch data of entity. Returns the 'Promise'.
	fetchData(entityId)
		.then( (data) => {
			// Data is in form 'array-of-arrays'.
			// converting all data string to lowercase.
			// 'd' denotes a 'row' of data. 
			for(let d of data) {
				customerDetails.push( d.map( (x) => x.toLowerCase() ) );
			}

			// [Default] Filtering data based on name.
			customerDetails = filterData(customerDetails, columnIndex['name']);

			// loading data to UI.
			loadData(customerDetails);
		});


	// referencing all column headers.
	let thEL = document.querySelectorAll('th:not(.empty-data)');

	// Callback to 'click' event to all column headers.
	function filterByColumn(e, data) {
		let columnName = e.target.textContent.toLowerCase();
		let index = columnIndex[columnName];

		// Remove the previous data.
		unLoadData();
		// Load the filtered data.
		loadData(filterData(data, index));
	}
	// Attaching 'click' event to all column headers.
	for (var i = 0; i < thEL.length; i++) {
		thEL[i].addEventListener('click', (e) => filterByColumn(e, customerDetails) );
	}






	function editBtnClickEvent() {
		var editingRow = this.parentNode;
		var editBtnId = editingRow.dataset.id;
		var editInputRow = document.querySelector('.edit-id-'+ editBtnId);

		// for not adding more than one editing row.
		if(!editInputRow) {
			if (window.confirm("Do you really want to update this record?")) { 
				var nodeList = editingRow.querySelectorAll("td");
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
						
						<td class="btn edit-btn" title="Update"><button type="button">Update</button></td>
						<td class="btn edit-row__close" title="Close"> <img src="assets/img/delete.png" alt="close"> </td>
					</tr>`);

				// setting the reference of edit-row to the variable.
				editInputRow = document.querySelector('.edit-id-'+ editBtnId);

				// Hide the editing node.
				editingRow.style.display = 'none';

				// reference to update & close button in editInputRow.
				var updateBtn = editInputRow.querySelector('button');
				var closeBtn = editInputRow.querySelector('.edit-row__close');

				// set event to close button.
				closeBtn.addEventListener('click', () => { closeBtnClickEvent(editInputRow, editingRow)	});

				// Set event to update button.
				updateBtn.addEventListener('click', function() { updateBtnClickEvent(editInputRow, editingRow) } );
		   }
		}
	}
	function closeBtnClickEvent(editInputRow, editingRow){
		// Remove the editInputRow
		editInputRow.parentNode.removeChild(editInputRow);

		// Show the editingRow
		editingRow.style.display = 'table-row';
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
	   	httpRequest.send('entityId='+entityId+'&name='+name+'&addr='+addr+'&city='+city+'&phno='+phno+'&editBtnId='+editBtnId);
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


	addCustomerForm.addEventListener('submit', function(e) {
		e.preventDefault();

		var name, addr, city, phno;
		name = document.querySelector('input[name="name"]').value;
		addr = document.querySelector('input[name="addr"]').value;
		city = document.querySelector('input[name="city"]').value;
		phno = document.querySelector('input[name="phno"]').value;

		if (!httpRequest) {
	   		alert('Error in making a ajax request');
	   	}
	   	httpRequest.onreadystatechange = function() { addCustomerRow(name, addr, city, phno) };
	   	httpRequest.open('POST', 'add_record.php');
	   	httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	   	httpRequest.send('entityId='+entityId+'&name='+name+"&addr="+addr+"&city="+city+"&phno="+phno);

	   	this.reset();
	});
	function addCustomerRow(name, addr, city, phno) {
		if (httpRequest.readyState === XMLHttpRequest.DONE) {
	    	if (httpRequest.status === 200) {
	    		let lastEl = document.querySelector('#add-row');

	    		// retrieving the cid form database.
	    		let cid = httpRequest.responseText;

	    		let rowData = [cid, name, addr, city, phno];

    			lastEl.insertAdjacentHTML('beforebegin', `
	    			<tr data-id="${cid}">
						<td>${name}</td>
						<td>${addr}</td>
						<td>${city}</td>
						<td>${phno}</td>
						<td class="btn del"><img src="assets/img/delete.png" alt="delete"></td>
						<td class="btn edit"><img src="assets/img/edit.png" alt="edit"></td>
	    			</tr>`);

    			// Add row to customerDetails variable.
    			customerDetails.push(rowData);

    			var newRowEL = document.querySelector(`tr[data-id='${cid}']`);
	    		let newDelBtn = newRowEL.querySelector('.del');
	    		let newEditBtn = newRowEL.querySelector('.edit');

    			newDelBtn.addEventListener('click', (e) => { deleteRecord(e, entityId) } );
				newEditBtn.addEventListener('click', editBtnClickEvent);	

	    		// Notifying the message.
	    		notify('Customer added successfully.');
	     	} 
	     	else {
	     		// Notifying the message.
	    		notify('There was a problem adding the customer.');
	      	}
	   	}
	}
})();