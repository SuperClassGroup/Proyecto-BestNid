$(document).ready(function(){
	$('.materialboxed').materialbox();
  
	$(".button-collapse").sideNav();
  
	$('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrain_width: false, // Does not change width of dropdown to that of the activator
      hover: false, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: false// Displays dropdown below the button
    });
	
	$('.collapsible').collapsible({
		accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
	});
	
	$('.modal-trigger').leanModal();

	
	$('.datepicker').pickadate({
	selectMonths: false, // Creates a dropdown to control month
	selectYears: false, // Creates a dropdown of 15 years to control year
	});


});