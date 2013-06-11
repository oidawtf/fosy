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
            <link rel="stylesheet" href="css/site.css">
            <link rel="stylesheet" href="css/layout.css">
            
            <script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
            <script type="text/javascript" src="js/hideshow.js"></script>
            <script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
            <script type="text/javascript" src="js/jquery.equalHeight.js"></script>
            
            <script type="text/javascript">
                $(document).ready(function()
                    {
                        $(".tablesorter").tablesorter();
                    }
                );
                $(document).ready(function() {
                    //When page loads...
                    $(".tab_content").hide(); //Hide all content
                    $("ul.tabs li:first").addClass("active").show(); //Activate first tab
                    $(".tab_content:first").show(); //Show first tab content
                    //On Click Event
                    $("ul.tabs li").click(function() {
                        $("ul.tabs li").removeClass("active"); //Remove any "active" class
                        $(this).addClass("active"); //Add "active" class to selected tab
                        $(".tab_content").hide(); //Hide all tab content
                        var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
                        $(activeTab).fadeIn(); //Fade in the active ID content
                        return false;
                    });
                });

                $(function(){
                    $('.column').equalHeight();
                });
                
                function getXmlHttpRequest()
                {
                    var xmlhttp;

                    if (window.XMLHttpRequest)  // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                    else                        // code for IE6, IE5
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

                    return xmlhttp;
                }
            </script>
            
            <title>FOSY - Felix Online Systems</title>
    </head>

    <?php
    
    include "includes.php";
    
    // Login clicked
    if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password']))
        if (authenticationController::isLoginValid($_POST['username'], $_POST['password'])) {
            authenticationController::login($_POST['username']);
        }
    
    // Logout clicked
    if (isset($_POST['logout']))
        authenticationController::logout();

    ?>

    <body>
	
        <?php
        
        include "ui/header.php";
        
        if (authenticationController::isLoggedIn())
            include "ui/navi.php";
            
        ?>
		
        <div id="content">
            <?php include controller::getContentItem()->getUrl(); ?>
	</div>
        
        <?php include "ui/footer.php"; ?>
        
    </body>
</html>