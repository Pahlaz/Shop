(function() {
  	'use strict';

	var httpRequest = new XMLHttpRequest();
	
	var columnIndex = {
		'name': 1,
		'category': 2,
		'brand': 3,
		'price': 4
	};
	var productDetails = [];
	
	var addProductForm = document.querySelector('#add_product');
	var entityId = 'product';


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
				productDetails.push( d.map( (x) => x.toLowerCase() ) );
			}

			// [Default] Filtering data based on name.
			productDetails = filterData(productDetails, columnIndex['name']);

			// loading data to UI.
			loadData(productDetails);
		})
		.catch( (error) => {
			console.log("Error: Can't able to fetch "+ entityId + "data.");
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
		thEL[i].addEventListener('click', (e) => filterByColumn(e, productDetails) );
	}


	// edit button 'click' event callback.
	function editBtnClickEvent() {
		var editingRow = this.parentNode.parentNode;
		var editBtnId = editingRow.dataset.id;
		var editInputRow = document.querySelector('.edit-id-'+ editBtnId);

		// for not adding more than one editing row.
		if(!editInputRow) {
			if (window.confirm("Do you really want to update this record?")) { 
				var nodeList = editingRow.querySelectorAll("td");
				// initializing the values.
				var oldName = nodeList[0].innerText;
				var oldCategory = nodeList[1].innerText;
				var oldBrand = nodeList[2].innerText;
				var oldPrice = nodeList[3].innerText;

				// Inserting editInputRow in DOM and adding old values in it.
				editingRow.insertAdjacentHTML('afterend', `
		    		<tr id="edit-row" class="edit-id-${editBtnId}">
						<td><input type="text" name="name" value="${oldName}"></td>
						<td><input type="text" name="category" value="${oldCategory}"></td>
						<td><input type="text" name="brand" value="${oldBrand}"></td>
						<td><input type="number" name="price" value="${oldPrice}"></td>
						
						<td class="btn"><button class="update" title="Update">Update</button></td>
						<td class="btn"> <button class="close" title="Close"></button> </td>
					</tr>`);

				// setting the reference of edit-row to the variable.
				editInputRow = document.querySelector('.edit-id-'+ editBtnId);

				// Hide the editing node.
				editingRow.style.display = 'none';

				// reference to update & close button in editInputRow.
				var updateBtn = editInputRow.querySelector('.update');
				var closeBtn = editInputRow.querySelector('.close');

				// set event to close button.
				closeBtn.addEventListener('click', () => { closeBtnClickEvent(editInputRow, editingRow)	});

				// Set event to update button.
				updateBtn.addEventListener('click', function() { updateBtnClickEvent(editInputRow, editingRow) } );
		   }
		}
	}
	// close button 'click' event callback.
	function closeBtnClickEvent(editInputRow, editingRow){
		// Remove the editInputRow
		editInputRow.parentNode.removeChild(editInputRow);

		// Show the editingRow
		editingRow.style.display = 'table-row';
	}
	// update button 'click' event callback.
	function updateBtnClickEvent(editInputRow, editingRow){
		var editBtnId = editingRow.dataset.id;

		// fetching the updated values of editingRow.
		var name = editInputRow.querySelector('input[name="name"]').value;
		var category = editInputRow.querySelector('input[name="category"]').value;
		var brand = editInputRow.querySelector('input[name="brand"]').value;
		var price = editInputRow.querySelector('input[name="price"]').value;

		if (!httpRequest) {
	      	alert('Error in making a ajax request');
	   	}
	   	httpRequest.onreadystatechange = function() { updateRecord(editingRow, editInputRow) };
	   	httpRequest.open('POST', 'edit_record.php');
	   	httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	   	httpRequest.send('entityId='+entityId+'&name='+name+'&category='+category+'&brand='+brand+'&price='+price+'&editBtnId='+editBtnId);
	}
	function updateRecord(editingRow, editInputRow) {
	    if (httpRequest.readyState === XMLHttpRequest.DONE) {
	    	if (httpRequest.status === 200) { 
				var nodeList = editingRow.querySelectorAll("td");
	    		// Reflect the changes to editingRow.
	    		nodeList[0].innerText = editInputRow.querySelector('input[name="name"]').value;
				nodeList[1].innerText = editInputRow.querySelector('input[name="category"]').value;
				nodeList[2].innerText = editInputRow.querySelector('input[name="brand"]').value;
				nodeList[3].innerText = editInputRow.querySelector('input[name="price"]').value;

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

	
	addProductForm.addEventListener('submit', function(e) {
		e.preventDefault();

		var name, category, brand, price;

		name = document.querySelector('input[name="name"]').value;
		category = document.querySelector('input[name="category"]').value;
		brand = document.querySelector('input[name="brand"]').value;
		price = document.querySelector('input[name="price"]').value;

		if (!httpRequest) {
	   		alert('Error in making a ajax request');
	   	}
	   	httpRequest.onreadystatechange = function() { addRecord(name, category, brand, price) };
	   	httpRequest.open('POST', 'add_record.php');
	   	httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	   	httpRequest.send('entityId='+entityId+'&name='+name+"&category="+category+"&brand="+brand+"&price="+price);

	   	this.reset();
	});
	function addRecord(name, category, brand, price) {
		if (httpRequest.readyState === XMLHttpRequest.DONE) {
	    	if (httpRequest.status === 200) {
	    		let contentFirstEl = document.querySelector('#add-row');

	    		// retrieving the id form database.
	    		let id = httpRequest.responseText;

	    		let rowData = [id, name, category, brand, price];

    			contentFirstEl.insertAdjacentHTML('afterend', `
	    			<tr data-id="${id}">
						<td>${name}</td>
						<td>${category}</td>
						<td>${brand}</td>
						<td>${price}</td>
						<td class="btn"> <button class="del" title="Delete"></button> </td>
						<td class="btn"> <button class="edit" title="Edit"></button> </td>
	    			</tr>`);

    			// Add row to productDetails variable.
    			productDetails.push(rowData);


    			let newRowEL = document.querySelector(`tr[data-id='${id}']`);
	    		let newDelBtn = newRowEL.querySelector('.del');
	    		let newEditBtn = newRowEL.querySelector('.edit');

    			newDelBtn.addEventListener('click', (e) => { deleteRecord(e, entityId) });
				newEditBtn.addEventListener('click', editBtnClickEvent);	

	    		// Notifying the message.
	    		notify('Product added successfully.');
	     	} 
	     	else {
	     		// Notifying the message.
	    		notify('There was a problem adding the product.');
	      	}
	   	}
	}

})();