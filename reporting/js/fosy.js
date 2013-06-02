$(function() {
	$("#datepicker").datepicker({
		showOn: "button",
		autoSize: true,
		buttonImage: "img/calendar.gif",
		buttonImageOnly: true,
		buttonText: "Datum",
		dateFormat: "dd.mm.yy",
		
	});
});

/* mouse over for navigation */
$(function() {
	$("nav ul li a").hover(function(){$(this).addClass("ui-state-hover");},function(){$(this).removeClass("ui-state-hover");})
});

/* navi elements as buttons */
$(function() {
	$("nav ul li a").button();
});

/* define every button as button */
$(function() {
	$( "button" ).button();
});