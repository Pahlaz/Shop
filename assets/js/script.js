(function() {
  'use strict';

  // MENU BUTTON
  $('.toggle-btn').on('click', function(){  
    $('nav').toggleClass('onclick');
  });

  // CLOSE BUTTON
  $('.close-btn').on('click', function(){  
    $('nav').toggleClass('onclick');
  });

  // LOGGED IN ACCOUNT MENU
  $('.account').on('click', () => {
    $('.account .menu').toggle();
  });


	
})();