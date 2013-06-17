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

<script type="text/javascript">

function OnApplyFilter(type, campaignId, id, checked)
{
    var xmlhttp = getXmlHttpRequest();
    var url = "ui/selectionChanged.php";
    var params = "type=" + type + "&campaignId=" + campaignId + "&id=" + id + "&checked=" + checked;

    xmlhttp.open("POST", url, true);

    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", params.length);
    xmlhttp.setRequestHeader("Connection", "close");

    xmlhttp.send(params);
}
</script>

<section id="main" class="column" style="height: 90%;">
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=addarticlestocampaign&campaignId=<?php echo $campaign->id; ?>">
        
        <?php
        if ($campaign->medium == "email")
            echo "<h4 class='alert_warning'>Es werden nur Kunden angezeigt, die eine email eingetragen haben.</h4>";
        ?>
        
        <article class="module width_full">
            
            <header>
                <h3 class="tabs_involved">Kundenauswahl</h3>
            </header>

            <div class="table-wrapper">
                <div class="table-scroll">
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
                            <tr>
                                <form class="quick_search" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <td></td>
                                    <td>
                                        <input type="text" name="search" onclick="" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="Name...">
                                    </td>
                                    <td>
                                        <input type="text" name="search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="Geburtsdatum...">
                                    </td>
                                    <td>
                                        <input type="text" name="search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="ZIP Code...">
                                    </td>
                                </form>
                            </tr>
                            
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
        
        </article>
    </form>
    
    <div class="spacer clear"></div>
    
</section>
