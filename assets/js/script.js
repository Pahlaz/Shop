'use strict';

// MENU BUTTON
$('.toggle-btn').on('click', () => {	
	$('nav').toggleClass('onclick');
});

// CLOSE BUTTON
$('.close-btn').on('click', () => {  
  $('nav').toggleClass('onclick');
});

// LOGGED IN ACCOUNT MENU
$('.account .toggle-menu').on('click', () => {
	$('.account .menu').toggle();
});


var notifyEl = document.querySelector('.notify');

// For notifying the message in the header.
function notify(message) {
  	// Notifying the message.
  	notifyEl.querySelector('.notify__msg').textContent = message;
  	notifyEl.style.display = 'block';

  	// Automatically hiding the notification after 4 seconds.
  	setTimeout(() => {
		notifyEl.style.display = 'none';
		// remove the message.
		notifyEl.querySelector('.notify__msg').textContent = "";
  	}, 3000);
}
// For hiding the notification.
notifyEl.querySelector('.notify__close-btn').addEventListener('click', () => {
  	notifyEl.style.display = 'none';
});

// For capitalizing string's first character to uppercase.
function capitalize(string) {
  	return string.charAt(0).toUpperCase() + string.slice(1);
}


// for sorting data. Returns callback to sort() method in filterData() method.
function comparator(index) {
	return (a, b) => {
				if( !isNaN(a[index]) && !isNaN(b[index]) ) {
					// sorting integers.
					if( parseInt(a[index]) > parseInt(b[index]) ) {
						return 1;
					}
					else if( parseInt(a[index]) < parseInt(b[index]) ) {
						return -1;
					}
					return 0;
				}
				else {
					// sorting strings.
					if( a[index] > b[index] ) {
						return 1;
					}
					else if( a[index] < b[index] ) {
						return -1;
					}
					return 0;
				}
			}
}
// For sorting based on column.
function filterData(data, index) {
	return data.sort(comparator(index));
}


// Fetching data of entity from database.
function fetchData(entityId) {
	var myHeaders = new Headers();
	myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

	var myInit = { 
					method: 'POST',
					body: `entityId=${entityId}`,
					headers: myHeaders,
					mode: 'same-origin',
					cache: 'default' 
				};

    // Fetching data from database
	return fetch('fetch_details.php', myInit)
				.then( (response) => response.json() );
}
// For removing all data.
function unLoadData() {
	let contentEL = document.querySelector('.content');
	let contentELChilds = contentEL.querySelectorAll('tr:not(#add-row)');

	for(let child of contentELChilds) {
		contentEL.removeChild(child);
	}
}

// For deleting the record, it's a callback to delete button. 'e' is event to delete button.
function deleteRecord(e, entityId) {
	var delRowEL = e.target.parentNode.parentNode;
	var id = delRowEL.dataset.id;

	if (window.confirm("Do you really want to delete this record?")) {
    	var myHeaders = new Headers();
		myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

		var myInit = { 
						method: 'POST',
						body: `entityId=${entityId}&id=${id}`,
	               		headers: myHeaders,
	               		mode: 'same-origin',
	               		cache: 'default' 
	               	};

	    // Deleting the record from database.
		fetch('del_record.php', myInit)
			.then( (response) => response.text() )
			.then( (message) => {
				// remove the delRowEl form DOM.
    			delRowEL.parentNode.removeChild(delRowEL);

				notify(message);
			});
	}
}
