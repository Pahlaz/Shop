(function() {
  	'use strict';

  	////////////////////////////////////////
	// Text Editor
	///////////////////////////////////////
	var editor = ace.edit("editor-area");
	var mode = $('.lang select').val();
	var textarea = $('#code');

	editor.setTheme("ace/theme/monokai");
	editor.getSession().setMode("ace/mode/c_cpp");

	// Setting the mode of selected language
	$('.lang select').on('change', function(){
		var newMode = $('.lang select').val();
		editor.getSession().setMode("ace/mode/" + newMode);
	});

	// Inserting the code in textarea
	editor.getSession().on('change', function () {
       	textarea.val(editor.getSession().getValue());
   	});
   	textarea.val(editor.getSession().getValue());


   	////////////////////////////////////////////
   	// AJAX Request
   	////////////////////////////////////////////
   	var httpRequest = new XMLHttpRequest();
   	var runBtn = document.getElementById('run');
   	var submitBtn = document.getElementById('submit');
   	var output = document.getElementById('output');
	
	runBtn.onclick = () => {
		output.innerHTML = ' ';
		if (!httpRequest) {
	      alert('Error in making a ajax request');
	    }
	    httpRequest.onreadystatechange = runCode;
	    httpRequest.open('GET', 'compile.php');
	    httpRequest.send();
	}
	function runCode() {
	    if (httpRequest.readyState === XMLHttpRequest.DONE) {
	    	if (httpRequest.status === 200) {
	        	output.innerHTML = httpRequest.responseText;
	        	output.style.display = 'block';
	     	} else {
	        	alert('There was a problem with the request.');
	      	}
	    }
	}

})();