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
		<div id="wrapper">
			<!-- header start -->
			<?php if(authenticationController::isLoggedIn()) { include "header.php"; } ?>
			<!-- header end -->
			
			<!-- navi start -->
			<?php if(authenticationController::isLoggedIn()) { include "navi_auftragsmgmt.php"; } ?>
			<!-- navi end -->


			<?php
				if(authenticationController::isLoggedIn()) {
					echo "<div id=\"content\">";
						include "content.php";
						// TODO WHITE LIST!
					echo "</div>";
				}
			?>

				<?php
					if(!authenticationController::isLoggedIn()){
						include "login.php";
					}
				?>

			<?php if(authenticationController::isLoggedIn()) { include "footer.php"; } ?>
		</div>
    </body>
</html>