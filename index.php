<!DOCTYPE html>
<!-- 	Attention: this website is written in html5. 
		If it doesn't work correctly try it in chrome 
		(because it was developed for Chrome Version 26.0.1410.65).
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
        <link rel="stylesheet" href="css/layout.css">
	
	<title>FOSY - Felix Online Systems</title>
</head>	

<body>
	
	<!-- if not logged in show login page -->
	<div id="loginhelper"></div>
	<div id="login">
		<?php require("login.php"); ?>
	</div>
	
	<!-- else show empty content page -->
	<header>
		<?php require("header.php"); ?>
	</header>
		
	<nav>
		<?php /*require("navi.php");*/ ?>
	</nav>
		
	<div id="content">
		<!-- TODO -->
		<?php /*require("content.php");*/ ?>
	</div>
		
	<footer>
		<?php /*require("footer.php");*/ ?>
	</footer>
		
	<?php
		//echo "Hello World - This is FOSY!<br/>"; 
		//echo $_SERVER['HTTP_HOST'];
	?>
		
</body>
</html>