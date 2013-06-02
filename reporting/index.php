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
		<script type="text/javascript" src="js/fosy.js"></script>

		<title>FOSY - Felix Online Systems</title>
	</head>

    <?php
    	require("util/includeMgr.inc.php");
	
		// Login clicked
		if(isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])) {
			if(isLoginValid($_POST['username'], $_POST['password'])) {
				login($_POST['username']);
			}
		}
    
	    // Logout clicked
    	if(isset($_POST['logout'])) {
    		logout();
	    }
    ?>

    <body>

	<div id="wrapper">
	
		<!-- header start -->
		<?php if(isLoggedIn()) { include "header.php"; } ?>
		<!-- header end -->
		
		<!-- navi start -->
		<?php if(isLoggedIn()) { include "navi.php"; } ?>
		<!-- navi end -->

		<div id="content">
			<?php
			
				if(isLoggedIn()) {
					if(isset($_GET['content'])) {
						switch($_GET['content']) {
							case 'dashboard':
							case 'flexibleReports':
							case 'erErfassen':
							case 'erErfassenSuccess':
							case 'ustVA':
							case 'plandatenverwaltung':
							case 'planIstVergleich':
								@include $_GET['content'].'.php';
								break;
							default:
								echo "<h1>Sorry, Page ".$_GET['content']." not found.";
								break;
						}
					}
				}else {
					include "login.php";
				}

			?>
		</div>
		
		<!-- footer start -->
		<?php if(isLoggedIn()) { include "footer.php"; } ?>
		<!-- footer end -->
	</div><!-- wrapper end -->

    </body>
</html>