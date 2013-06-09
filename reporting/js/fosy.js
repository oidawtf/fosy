/* init */

$(function() {
	$("#datepicker").datepicker({
		showOn: "button",
		autoSize: true,
		buttonImage: "img/calendar.gif",
		buttonImageOnly: true,
		buttonText: "Datum",
		dateFormat: "dd.mm.yy"
	});
	
	/* mouse over for navigation */
	$("nav ul li a").hover(
		function(){
			$(this).addClass("ui-state-highlight-navi");
		},
		function(){
			$(this).removeClass("ui-state-highlight-navi");
		}
	);

	/* navi elements as buttons, every button as button, every a with class button as button */
	$("nav ul li a, button, a.button").button();

	/* tax boxes */
	$("#taxError").hide();
	$("#taxOutput").hide();
	
	/* calculate tax */
	$("#calculate").click(function() {
		bruttoBetrag = $("#bruttoBetrag").val();
		parseFloat(bruttoBetrag);
		
		if(bruttoBetrag != "" && bruttoBetrag > 0) {
			if(!isNaN(bruttoBetrag)) {
				
				tax = $("input:radio:checked[name='tax']").val();
				
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
				$("#taxError").text("Bitte Brutto-Betrag im gültigen Format (xxxx.yy) eingeben.").show();
			}
		}else {
			$("#taxOutput").hide();
			$("#taxError").show();
			$("#taxError").text("Bitte Brutto-Betrag im gültigen Format (xxxx.yy) eingeben.").show(); 
		}
	});
	
	/* plandatenverwalten kz selected */
	$("#plandaten-select").change(function() {
		$("#plandaten-select option:selected").each(function() {
			var id = $(this).val();
			if(id > 0) {
				getPlannedValues(id);
			}
		});
	});
});

/* AJAX Request for planned Value */
var req = null;
function getPlannedValues(id) {
	var pos = document.URL.lastIndexOf("/");
	var url = document.URL.substring(0,pos+1);
	
	if(window.XMLHttpRequest) {
		req = new XMLHttpRequest();
	}else if(window.ActiveXObject) {
		req = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	req.onreadystatechange = displayPlannedValue;
	req.open("GET", url+"util/getPlannedValue.ajax.php?id="+id);
	req.send(null);
}
function displayPlannedValue() {
	if(req.readyState == 4) {
		$('#resultDiv').html(req.responseText);
	}
}

/* Presentation for calculated tax value */
function kaufm(x) {
	var k = (Math.round(x * 100) / 100).toString();
	k += (k.indexOf('.') == -1)? '.00' : '00';
	var p = k.indexOf('.');
	return k.substring(0, p) + '.' + k.substring(p+1, p+3);
}
/* calculate tax end */