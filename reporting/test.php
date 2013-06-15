<!DOCTYPE html>
<!-- 	Attention: this website is written in html5. 
		If it doesn't work correctly try it in Firefox 
		(because it was developed for Firefox Version 21).
-->
<html>
    <head>
		<!--[if lte IE 8]>
			<script src="js/excanvas.js"></script>
		<![endif]-->
		<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="js/Chart.js"></script>
		<script type="text/javascript">
		$(function() {
			var data = {
				labels : ["Juni 2013","2. Quartal 2013","2013"],
				datasets : [ {
					fillColor : "#d0e5f5",//"#a6c9e2",
					strokeColor : "#4297d7",
					data : [65,59,70]
				}]
			};
			
			var opts = { 
//				scaleOverlay:true, 
				scaleOverride:true, 
				scaleSteps:3, // todo calculate
				scaleStepWidth:50, // todo calculate
			};

			//Get the context of the canvas element we want to select
			var ctx = $("#myChart").get(0).getContext("2d");
			//var myNewChart = new Chart(ctx).Bar(data,options);
			var myNewChart = new Chart(ctx).Bar(data, opts);
		});
			
		</script>
		
		<title>FOSY - Felix Online Systems</title>
	</head>
	<body>
	
		<canvas id="myChart" width="350" height="300"></canvas>

	

</body>
</html>