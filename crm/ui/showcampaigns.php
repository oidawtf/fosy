<?php

authenticationController::checkAuthentication();

$campaigns = controller::getCampaigns();

?>


<section id="main" class="column" style="height: 90%;">
    
    <article class="module width_full" style="float:left">
        
        <header>
            <h3 class="tabs_involved">Kampagnen</h3>
        </header>

        <div class="table-wrapper">
            <div class="table-scroll">
                <table cellspacing="0" class="tablesorter">
                    <thead>
                        <tr> 
                            <th class="header">Betreff</th>
                            <th class="header">Beschreibung</th>
                            <th class="header">Ziel</th>
                            <th class="header">Von</th>
                            <th class="header">Bis</th>
                            <th class="header">Budget</th>
                            <th class="header">Kunden</th>
                            <th class="header">Artikel</th>
                            <th class="header" style="width: 100px;">Aktionen</th>
                        </tr> 
                    </thead>
                    <tbody>
                        
                        <?php
                        
                        foreach ($campaigns as $campaign) {
                            echo "<tr>";
                            echo    "<td>".$campaign->getNameTrimmed()."</td>";
                            echo    "<td>".$campaign->getDescriptionTrimmed()."</td>";
                            echo    "<td>".$campaign->getGoalTrimmed()."</td>";
                            echo    "<td>".$campaign->date_from."</td>";
                            echo    "<td>".$campaign->date_to."</td>";
                            echo    "<td>".$campaign->budget."</td>";
                            echo    "<td>".$campaign->customers."</td>";
                            echo    "<td>".$campaign->articles."</td>";
                            echo    "<td>";
                            echo        "<form method='GET' action='".$_SERVER['PHP_SELF']."' style='float:left; margin-right: 10px;'>";
                            echo            "<input type='hidden' name='content' value='editcampaign' />";
                            echo            "<input type='hidden' name='campaignId' value='".$campaign->id."' />";
                            echo            "<input type='image' title='Bearbeiten' src='images/icn_edit.png'>";
                            echo        "</form>";
                            echo    "<a href='ui/analyseCampaignPDF.php?campaignId=".$campaign->id."' target='_blank'>Analyse</a>";
                            echo    "</td>";
                            echo "</tr>";
                        }
                        
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
        
    </article>
    
    <div class="spacer clear"></div>
    
</section>