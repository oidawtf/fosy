<header id="header">
    <hgroup>
        <h1 class="site_title">
            <a href="../index.php">Felix Online Systems</a>
        </h1>
        <h2 class="section_title"><?php echo controller::getContentItem()->getTitle(); ?></h2>
        <div class="btn_view_site">
            
            <?php
            
            if (authenticationController::isLoggedIn()) {
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

<?php
if (!authenticationController::isLoggedIn())
    return;
?>

<section id="secondary_bar">
    <div class="user">
        <p><?php echo authenticationController::getFullUsername(); ?></p>
    </div>
    <div class="breadcrumbs_container">
        <article class="breadcrumbs">
            
            <?php
            
            if (isset($_GET['search']) && strtolower($_GET['search']) == "lorem ipsum")
                $content = controller::getContentItem('easteregg');
            else
                $content = controller::getContentItem();
            
            if ($content->getParents() != NULL) {
                foreach($content->getParents() as $parentKey) {
                    $parent = controller::getContentItem($parentKey);
                    echo "<a href='".$_SERVER['PHP_SELF']."?content=".$parent->getId().$parent->computeIdParameter()."'>".$parent->getTitle()."</a>";
                    echo "<div class='breadcrumb_divider'></div>";
                }
            }
            echo "<a class='current' href='".$_SERVER['PHP_SELF']."?content=".$content->getId().$content->computeIdParameter()."'>".$content->getTitle()."</a>";
            
            ?>
            
        </article>
    </div>
</section>