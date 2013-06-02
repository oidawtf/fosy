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
            
            <script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
            <script type="text/javascript" src="js/hideshow.js"></script>
            <script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
            <script type="text/javascript" src="js/jquery.equalHeight.js"></script>

            <title>FOSY - Felix Online Systems</title>
    </head>

    <body>
	
	<header>
	</header>
        
        <nav>
        </nav>
		
        <div id="modules">
            <a href="auftragsMgmt/index.php"><img src="img/logo_auftragsMgmt.png" alt="FOSY - Auftragsmanagement"></a>
            <a href="crm/index.php"><img src="img/logo_CRM.png" alt="FOSY - Kundenmanagement"></a>
            <a href="reporting/index.php"><img src="img/logo_reporting.png" alt="FOSY - Reporting"></a>
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