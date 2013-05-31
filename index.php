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

    <?php

    include_once "businesslogic/dbaccess.php";
    include_once "businesslogic/controller.php";
    
    // Login clicked
    if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password']))
        if (controller::isLoginValid($_POST['username'], $_POST['password'])) {
            controller::Login($_POST['username']);
        }
    
    // Logout clicked
    if (isset($_POST['logout']))
        controller::Logout();

    ?>

    <body>
	
	<!-- else show empty content page -->
	<header>
	</header>
		
	<nav>
            <?php /*require("navi.php");*/ ?>
	</nav>
		
        <div id="content">
            <?php

            if (isset($_GET['content'])) {
                switch ($_GET['content']) {
                    case 'login.php':
                    // Add other .php files
                        @include 'ui/'.$_GET['content'];
                        break;

                    default:
                        echo $_GET['content']." - 404 - Not found! =(";
                        break;
                }
            }
            elseif(controller::isLoggedIn()) {
                include 'home.php';
            }
            else {
                include 'login.php';
            }

            ?>
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