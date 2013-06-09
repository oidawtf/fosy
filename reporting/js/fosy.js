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
	$("#indicatorsSelect").change(function() {
		$("#indicatorsSelect option:selected").each(function() {
			var id = $(this).val();
			if(id > 0) {
				getPlannedvalues(id);
			}
		});
	});
	
	/* plandaten anlegen kz selected */
	$("#indicatorsAddSelect").change(function() {
		$("#indicatorsAddSelect option:selected").each(function() {
			var id = $(this).val();
			if(id > 0) {
				getPeriods(id);
			}
		});
	});
	
});

/* plandaten anlegen period selected */
$(document).on('change', '#periodSelect', function() {
	$("#periodSelect option:selected").each(function() {
		var id = $(this).val();
		if(id > 0) {
			$("#plannedvalue").show();
		}
	});
});

/* AJAX Request for planned Value */
var req = null;
var pos = 0;
var url = null;
function initAjaxCall() {
	pos = document.URL.lastIndexOf("/");
	url = document.URL.substring(0,pos+1);
	
	if(window.XMLHttpRequest) {
		req = new XMLHttpRequest();
	}else if(window.ActiveXObject) {
		req = new ActiveXObject("Microsoft.XMLHTTP");
	}
}
function getPlannedvalues(id) {
	initAjaxCall();
	req.onreadystatechange = displayPlannedvalue;
	req.open("GET", url+"util/getPlannedvalue.ajax.php?id="+id);
	req.send(null);
}
function displayPlannedvalue() {
	if(req.readyState == 4) {
		$('#resultDiv').html(req.responseText);
	}
}

function getPeriods(id) {
	initAjaxCall();
	req.onreadystatechange = displayPeriods;
	req.open("GET", url+"util/getPeriods.ajax.php?id="+id);
	req.send(null);
}
function displayPeriods() {
	if(req.readyState == 4) {
		$('#periods').html(req.responseText);
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