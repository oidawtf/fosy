<?php session_start(); ?>
<!DOCTYPE html>
<!-- 	Attention: this website is written in html5. 
		If it doesn't work correctly try it in Firefox 
		(because it was developed for Firefox Version 21).
-->
<html>
    <head>
		<meta charset="UTF-8">
		<meta name="description" content="FOSY - Felix Online Systems">
		<meta name="author" content="Brunnhuber, Cibukcic, Hotko, Matthaei, Meissner, Piesel, Quidet, Reithofer, Wagner-Celik">
		<!--[if lte IE 8]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]
		-->
		<link rel="stylesheet" href="css/fosy.css" type="text/css">
		<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.css" type="text/css">
		
		<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" src="js/Chart.js"></script>
		<script type="text/javascript" src="js/fosy.js"></script>

		<title>FOSY - Felix Online Systems</title>
	</head>

    <?php
    	require("util/includeMgr.inc.php");
	
		// Login clicked
		if(isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])) {
			if(authenticationController::isLoginValid($_POST['username'], $_POST['password'])) {
				authenticationController::login($_POST['username']);
			}
		}
    
	    // Logout clicked
    	if(isset($_POST['logout'])) {
    		authenticationController::logout();
	    }
    ?>

    <body>

	<?php
		if(authenticationController::isLoggedIn()) {
			echo "<div id='wrapper'>";
			
			/* header start */
			include "header.php";
			/* header end */
				
			/* navi start */
			include "navi.php";
			/* navi end */
		
			/* content start */
			echo "<div id='content'>";
			 
			if(isset($_GET['content'])) {
				switch($_GET['content']) {
					case 'dashboard':
					case 'flexibleReports':
					case 'addIncomminginvoice':
					case 'addIncomminginvoiceSuccess':
					case 'manageUstVa':
					case 'ustVaPrintedSuccess':
					case 'managePlannedvalue':
					case 'plannedActualComparison':
					case 'impressum':
					case 'aboutus':
					case 'deletePlannedvalue':
					case 'deletePlannedvalueSuccess':
					case 'editPlannedvalue':
					case 'editPlannedvalueSuccess':
					case 'addPlannedvalue':
					case 'addPlannedvalueSuccess':
						@include "pages/".$_GET['content'].'.php';
						break;
					default:
						echo "<h2>Sorry, Page ".$_GET['content']." not found.</h2>";
						break;
				}
			}
			echo "</div>";
			/* content end */
			
			/* footer start */
			include "footer.php";
			/* footer end */
			
		}else {
			include "login.php";
		}
	?>
		
    </body>
</html>