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
	
	/* flexible Reports */
	$("#datepickerFrom").datepicker({
		showOn: "button",
		autoSize: true,
		buttonImage: "img/calendar.gif",
		buttonImageOnly: true,
		buttonText: "Datum",
		dateFormat: "dd.mm.yy"
	});
	$("#datepickerTo").datepicker({
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
	
	/* print button in ust va hide */
	$("#printButton").hide();
	
	/* calculate tax */
	$("#calculate").click(function() {
		bruttoBetrag = $("#bruttoBetrag").val();
		parseFloat(bruttoBetrag);
		
		if(bruttoBetrag != "" && bruttoBetrag > 0) {
			if(!isNaN(bruttoBetrag)) {
				
				rate = $("input:radio:checked[name='rate']").val();
				
				if(rate==10) { vst = bruttoBetrag / 11; }
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
	
	/* ust va jahr selected */
	$("#ustVAJahrSelect").change(function() {
		$("#ustVaNoData").remove();
	
		$("#ustVAJahrSelect option:selected").each(function() {
			var id = $(this).val();
			if(id > 0) {
				getUSTVATableForYear(id);
			}
		});
	});
	
	/* DASHBOARD */
	var maxValueForBar = 0;
	/* offers */
	if($("#chartOffer").get(0)) {
		var url="util/dashboardFunctionsOffers.ajax.php";
		$.getJSON(url,function(json){
			var dataOffer	= json["datasets"][0]
			var sumMonth 	= dataOffer["data"][0];
			var sumQuarter 	= dataOffer["data"][1];
			var sumYear 	= dataOffer["data"][2];
		
			var data = {
				labels : [json["labels"][0], json["labels"][1], json["labels"][2]],
				datasets : [ {
					fillColor : dataOffer["fillColor"],
					strokeColor : dataOffer["strokeColor"],
					data : [sumMonth, sumQuarter, sumYear]
				}]
			};
		
			maxValueForBar = dataOffer["data"][0];
			for(i = 1; i < dataOffer["data"].length; i++) {
				if(dataOffer["data"][i] > maxValueForBar)
				maxValueForBar = dataOffer["data"][i];
			}
		
			var opts = { 
				scaleOverride:true, 
				scaleSteps:3, 
				scaleStepWidth:maxValueForBar,
			};
		
			var chartOffer = $("#chartOffer").get(0).getContext("2d");
			var myNewChart = new Chart(chartOffer).Bar(data, opts);

		});
	}
	
	/* orders */
	if($("#chartOrder").get(0)) {
		var url="util/dashboardFunctionsOrders.ajax.php";
		$.getJSON(url,function(json){
			var dataOrder 	= json["datasets"][0]; 
			var sumMonth 	= dataOrder["data"][0];
			var sumQuarter 	= dataOrder["data"][1];
			var sumYear 	= dataOrder["data"][2];
		
			var data = {
				labels : [json["labels"][0], json["labels"][1], json["labels"][2]],
				datasets : [ {
					fillColor : dataOrder["fillColor"],
					strokeColor : dataOrder["strokeColor"],
					data : [sumMonth, sumQuarter, sumYear]
				}]
			};
		
			var opts = { 
				scaleOverride:true, 
				scaleSteps:3, 
				scaleStepWidth:maxValueForBar,
			};
		
			var chartOrder = $("#chartOrder").get(0).getContext("2d");
			var myNewChart = new Chart(chartOrder).Bar(data, opts);
		});
	}
	
	/* relations */
	if($("#chartRelation").get(0)) {
		var url="util/dashboardFunctionsRelations.ajax.php";
		$.getJSON(url,function(json){
			var dataOffer = json["datasets"][0];
			var dataOrder = json["datasets"][1];
		
			var sumMonthOffer 	= dataOffer["data"][0];
			var sumQuarterOffer = dataOffer["data"][1];
			var sumYearOffer 	= dataOffer["data"][2];
			var sumMonthOrder 	= dataOrder["data"][0];
			var sumQuarterOrder = dataOrder["data"][1];
			var sumYearOrder 	= dataOrder["data"][2];
		
			var data = {
				labels : [json["labels"][0], json["labels"][1], json["labels"][2]],
				datasets : [ {
					fillColor : dataOffer["fillColor"],
					strokeColor : dataOffer["strokeColor"],
					data : [sumMonthOffer, sumQuarterOffer, sumYearOffer]
				}, {
					fillColor : dataOrder["fillColor"],
					strokeColor : dataOrder["strokeColor"],
					data : [sumMonthOrder, sumQuarterOrder, sumYearOrder]
				}]
			};
		
			maxOffer = dataOffer["data"][0];
			for(i = 1; i < dataOffer["data"].length; i++) {
				if(dataOffer["data"][i] > maxOffer)
				maxOffer = dataOffer["data"][i];
			}
			maxOrder = dataOrder["data"][0];
			for(i = 1; i < dataOrder["data"].length; i++) {
				if(dataOrder["data"][i] > maxOrder)
				maxOrder = dataOrder["data"][i];
			}
			if(maxOffer > maxOrder) { max = maxOffer; }
		
			var opts = { 
				scaleOverride:true, 
				scaleSteps:3, 
				scaleStepWidth:max,
			};
		
			var chartRelation = $("#chartRelation").get(0).getContext("2d");
			var myNewChart = new Chart(chartRelation).Bar(data, opts);
				
		});
	}
	
	
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

/* ust va check box selected/unselected */
$(document).on('click', '.month', function() {
	var showButton = false;
	$(".month").each(function() {
		if($(this).is(':checked')) {
			showButton = true;
			return false;
		}
	});
	if(showButton) {
		$("#printButton").show();
	}else {
		$("#printButton").hide();
	}
});


/* INIT AJAX REQUESTS */
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

/* AJAX Request for planned Value */
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

/* AJAX Request for periods */
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

/* AJAX Request for ust va table */
function getUSTVATableForYear(year) {
	initAjaxCall();
	req.onreadystatechange = displayUstVaTable;
	req.open("GET", url+"util/getUstVaTable.ajax.php?year="+year);
	req.send(null);
}
function displayUstVaTable() {
	if(req.readyState == 4) {
		$("#resultDiv").html(req.responseText);
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