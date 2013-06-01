<header id="header">
    <hgroup>
        <h1 class="site_title">
            <a href="<?php echo $_SERVER["PHP_SELF"]; ?>">FOSY - Felix Online Systems</a>
        </h1>
        <h2 class="section_title"><?php echo controller::getContentTitle(); ?></h2>
        <div class="btn_view_site">
            
            <?php
            
            if (controller::isLoggedIn()) {
                echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>";
                echo    "<input type='hidden' name='logout'>";
                echo    "<a href='javascript:;' onclick='parentNode.submit();'>Logout</a>";
                echo "</form>";
            }
            else {
                echo "<form method='GET' action='".$_SERVER['PHP_SELF']."'>";
                echo    "<input type='hidden' name='content' value='login'>";
                echo    "<a href='javascript:;' onclick='parentNode.submit();'>Login</a>";
                echo "</form>";
            }

            ?>
        </div>
    </hgroup>
</header>