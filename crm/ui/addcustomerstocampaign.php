<?php

authenticationController::checkAuthentication();

if (!isset($_GET['campaignId']))
    return;

$campaignId = $_GET['campaignId'];

if (isset($_POST['editcampaign']))
    $campaign = controller::editCampaign($campaignId);
else
    $campaign = controller::getCampaign($campaignId);

$customers = controller::getCustomersByCampaign($campaign);

?>

<section id="main" class="column" style="height: 90%;">
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=addarticlestocampaign&campaignId=<?php echo $campaignId; ?>">
        
        <?php
        if ($campaign->medium == "email")
            echo "<h4 class='alert_warning'>Es werden nur Kunden angezeigt, die eine email eingetragen haben.</h4>";
        ?>
        
        <article class="module width_full">
            
            <header>
                <h3 class="tabs_involved">Kundenauswahl</h3>
            </header>

            <table cellspacing="0" class="tablesorter">
                <thead>
                    <tr>
                        <th class="header"></th>
                        <th class="header">Name</th>
                        <th class="header" style="width: 100px;">Geburtsdatum</th>
                        <th class="header">ZIP Code</th>
                    </tr>
                </thead>
                <tbody style="overflow: scroll; height: 300px;">
                    <?php

                    foreach ($customers as $customer) {
                        if ($customer->isSelected)
                            $checked = "checked=''";
                        else
                            $checked = "";
                        echo "<tr>";
                        echo    "<td><input name='isSelected' type='checkbox' ".$checked." value='".$customer->id."'</td>";
                        echo    "<td><a href='index.php?content=customerdetailsfromcampaign&customerId=".$customer->id."&campaignId=".$campaignId."'>".$customer->getFullName()."</a></td>";
                        echo    "<td style='width: 100px;'>".$customer->getBirthdate()."</td>";
                        echo    "<td>".$customer->zip."</td>";
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>

            <footer>
                <div class="submit_link">
                    <input type="submit" class="alt_btn" name="addcustomerstocampaign" value="Weiter zur Artikelauswahl" />
                </div>
            </footer>
        
        </article>
    </form>
    
    <div class="spacer clear"></div>
    
</section>
