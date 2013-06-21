<?php

authenticationController::checkAuthentication();
authenticationController::checkAuthorization();

if (!isset($_GET['campaignId']))
    return;

$campaignId = $_GET['campaignId'];

if (isset($_POST['editcampaign']))
    $campaign = controller::editCampaign($campaignId);
else
    $campaign = controller::getCampaign($campaignId);

$customers = controller::getCustomersByCampaign($campaign);

$nameFilter = NULL;
$yearFilter = NULL;
$zipFilter = NULL;
if (isset($_GET['nameFilter']))
    $nameFilter = $_GET['nameFilter'];
if (isset($_GET['yearFilter']))
    $yearFilter = $_GET['yearFilter'];
if (isset($_GET['zipFilter']))
    $zipFilter = $_GET['zipFilter'];

?>

<section id="main" class="column" style="height: 90%;">
        
    <?php
    if ($campaign->medium == "email")
        echo "<h4 class='alert_warning'>Es werden nur Kunden angezeigt, die eine email eingetragen haben.</h4>";
    ?>
        
    <article class="module width_full">
        <form class="quick_search" style="padding: 0px; text-align: left;" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            
            <header>
                <h3 class="tabs_involved">Filter</h3>
            </header>

            <div class="module_content">
                <table class="clear">
                    <tbody>
                        <tr>
                            <td style="width: 200px;"><label>Name</label></td>
                            <td><label>Geburtsjahr</label></td>
                            <td><label>ZIP</label></td>
                        </tr>
                        <tr>
                            <td><input style="width: 95%;" type="text" name="nameFilter" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="<?php echo $nameFilter; ?>"></td>
                            <td><input style="width: 95%;" type="text" name="yearFilter" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="<?php echo $yearFilter; ?>"></td>
                            <td><input style="width: 95%;" type="text" name="zipFilter" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="<?php echo $zipFilter; ?>"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <footer>
                <div class="submit_link">
                    <input type="hidden" name="content" value="addcustomerstocampaign" />
                    <input type="hidden" name="campaignId" value="<?php echo $campaign->id; ?>" />
                    <input type="submit" value="Anwenden" />
                </div>
            </footer>
                
        </form>
    </article>
        
    <article class="module width_full">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=addarticlestocampaign&campaignId=<?php echo $campaign->id; ?>">
                
            <header>
                <h3 class="tabs_involved">Kundenauswahl</h3>
            </header>

            <div class="table-wrapper">
                <div class="table-scroll" style="height: 400px;">
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
                                echo    "<td><input name='isSelected' onchange='OnSelectionChanged(\"customer\", \"".$campaign->id."\", this.value, this.checked)' type='checkbox' ".$checked." value='".$customer->id."'</td>";
                                echo    "<td><a href='index.php?content=customerdetailsfromcampaign&customerId=".$customer->id."&campaignId=".$campaign->id."'>".$customer->getFullName()."</a></td>";
                                echo    "<td style='width: 100px;'>".$customer->getBirthdate()."</td>";
                                echo    "<td>".$customer->zip."</td>";
                                echo "</tr>";
                            }
                            
                            echo "<tr style='height: inherit;'></tr>";

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <footer>
                <div class="submit_link">
                    <input type="submit" class="alt_btn" name="addcustomerstocampaign" value="Weiter zur Artikelauswahl" />
                </div>
            </footer>
    
        </form>
    </article>
    
    <div class="spacer clear"></div>
    
</section>
