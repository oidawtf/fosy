<?php

controller::checkAuthentication();

if (!isset($_POST['campaignId']))
    return;

$articles = controller::getArticlessByCampaign($_POST['campaignId']);

?>

<section id="main" class="column" style="height: 90%;">
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=finanlizecampaign">
        <article class="module width_half">
            
            <header>
                <h3 class="tabs_involved">Artikelauswahl</h3>
            </header>

            <div class="module_content">
                <table cellspacing="0" class="tablesorter">
                    <thead>
                        <tr> 
                            <th class="header">Betreff</th>
                            <th class="header">Text</th>
                            <th class="header" style="width: 120px;">Sachbearbeiter</th>
                            <th class="header" style="width: 100px;">Status</th>
                            <th class="header" style="width: 100px;">Datum</th>
                        </tr> 
                    </thead>
                    <tbody style='overflow: scroll; height: 300px;'>
                        <?php
                        
                        foreach ($articles as $article) {
                            echo "<tr>";
                            echo    "<td><input name='isSelected' type='checkbox' value='".$article->id."'</td>";
                            echo    "<td><a href='index.php?content=customerdetails&id=".$article->id."'>".$article->getFullName()."</a></td>";
                            echo    "<td style='width: 100px;'>".$article->getBirthdate()."</td>";
                            echo    "<td>".$article->zip."</td>";
                            echo "</tr>";
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>
            
            <footer>
                <div class="submit_link">
                    <input type="submit" class="alt_btn" name="addarticlestocampaign" value="Weiter zur Finalisierung" />
                </div>
            </footer>
            
        </article>

    </form>
    
    <div class="spacer clear"></div>
    
</section>

