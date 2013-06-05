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

/* init layouts */

$(function() {
	/* error box class */
	$("#error").addClass("ui-state-error");

	/* div saveSuccess highlight */
	$("#saveSuccess").addClass("ui-state-highlight");

	/* header and footer layout */
	$("header").addClass("ui-widget ui-widget-content-white ui-corner-all");
	$("footer").addClass("ui-widget-header ui-corner-all");

	/* mouse over for navigation */
	$("nav ul li a").hover(function(){$(this).addClass("ui-state-highlight-navi");},function(){$(this).removeClass("ui-state-highlight-navi");})

	/* navi elements as buttons, every button as button */
	$("nav ul li a, button").button();

	$("fieldset").addClass("ui-widget ui-widget-content-white ui-corner-all");
	
	/* define every input field */
	$("input").addClass("ui-widget ui-widget-content ui-corner-all");
	
	

});


/* calculate tax */
$(function() {
	$("#taxError").addClass("ui-state-error").hide();
	$("#taxOutput").addClass("ui-state-highlight").hide();
	$("#nettoBetrag").prop("disabled",true);
	$("#vst").prop("disabled", true);
});

$(function() {
	$("#calculate").click(function() {
		belegNr = $("#belegNr").val();
		bruttoBetrag = $("#bruttoBetrag").val();
		tax = $("input:radio:checked[name='tax']").val();
				
		if(belegNr!="" && bruttoBetrag!="") {
			if(tax==10) { vst = bruttoBetrag / 11; }
			else{ vst = bruttoBetrag / 6; }
			nettoBetrag = bruttoBetrag - vst;
				
			$("#taxError").hide();
			$("#taxOutput").show();
			$("#nettoBetrag").val(kaufm(nettoBetrag)+" €");
			$("#vst").val(kaufm(vst)+" €");
		}else {
			$("#taxOutput").hide();
			$("#taxError").show();
			if(bruttoBetrag <= 0) { 
				$("#taxError").text("Brutto-Betrag darf nicht kleiner oder gleich 0 sein.").show(); 
			}
		}
	});
});
function kaufm(x) {
	var k = (Math.round(x * 100) / 100).toString();
	k += (k.indexOf('.') == -1)? '.00' : '00';
	var p = k.indexOf('.');
	return k.substring(0, p) + ',' + k.substring(p+1, p+3);
}
/* calculate tax end */