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

$articles = controller::getArticlessByCampaign($campaign);

$categoryFilter = NULL;
$manufacturerFilter = NULL;
$stockFilter = NULL;
if (isset($_GET['categoryFilter']))
    $categoryFilter = $_GET['categoryFilter'];
if (isset($_GET['manufacturerFilter']))
    $manufacturerFilter = $_GET['manufacturerFilter'];
if (isset($_GET['stockFilter']))
    $stockFilter = $_GET['stockFilter'];

?>

<script type="text/javascript">

function OnArticleSelectionChanged(type, campaignId, id, checked) {
    OnSelectionChanged(type, campaignId, id, checked);
    document.getElementById('real_price_' + id).disabled = !checked;
}

function OnRealPriceChanged(campaignId, articleId, realprice) {
    var xmlhttp = getXmlHttpRequest();
    var url = "ui/updaterealprice.php";
    var params = "campaignId=" + campaignId + "&articleId=" + articleId + "&realprice=" + realprice;

    xmlhttp.open("POST", url, true);

    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", params.length);
    xmlhttp.setRequestHeader("Connection", "close");

    xmlhttp.send(params);
}

</script>

<section id="main" class="column" style="height: 90%;">
    
    <article class="module width_full">
        <form class="quick_search" style="padding: 0px; text-align: left;" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            
            <header>
                <h3 class="tabs_involved">Filter</h3>
            </header>

            <div class="module_content">
                <table class="clear">
                    <tbody>
                        <tr>
                            <td style="width: 200px;"><label>Kategorie</label></td>
                            <td><label>Hersteller</label></td>
                            <td><label>Mininmum Lagerbestand</label></td>
                        </tr>
                        <tr>
                            <td><input style="width: 95%;" type="text" name="categoryFilter" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="<?php echo $categoryFilter; ?>"></td>
                            <td><input style="width: 95%;" type="text" name="manufacturerFilter" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="<?php echo $manufacturerFilter; ?>"></td>
                            <td><input style="width: 95%;" type="text" name="stockFilter" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="<?php echo $stockFilter; ?>"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <footer style="clear: both;">
                <div class="submit_link">
                    <input type="hidden" name="content" value="addarticlestocampaign" />
                    <input type="hidden" name="campaignId" value="<?php echo $campaign->id; ?>" />
                    <input type="submit" value="Anwenden" />
                </div>
            </footer>
                
        </form>
    </article>
    
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=finalizecampaign&campaignId=<?php echo $campaign->id; ?>">
        <article class="module width_full">
            
            <header>
                <h3 class="tabs_involved">Artikelauswahl</h3>
            </header>

            <div class="table-wrapper">
                <div class="table-scroll" style="height: 400px;">
                    <table cellspacing="0" class="tablesorter">
                        <thead>
                            <tr> 
                                <th class="header"></th>
                                <th class="header">Artikel</th>
                                <th class="header">Kategorie</th>
                                <th class="header">Hersteller</th>
                                <th class="header">Model</th>
                                <th class="header">Lagerbestand</th>
                                <th class="header">Verkaufspreis</th>
                                <th class="header">Kampagnenpreis</th>
                            </tr> 
                        </thead>
                        <tbody style='overflow: scroll; height: 300px;'>
                            <?php

                            foreach ($articles as $article) {
                                if ($article->isSelected) {
                                    $checked = "checked=''";
                                    $enabled = "";
                                }
                                else {
                                    $checked = "";
                                    $enabled = "disabled=''";
                                }
                                echo "<tr>";
                                echo    "<td><input name='isSelected' onchange='OnArticleSelectionChanged(\"article\", \"".$campaign->id."\", this.value, this.checked)' type='checkbox' ".$checked." value='".$article->id."'</td>";
                                echo    "<td><a href='index.php?content=articledetailsfromcampaign&articleId=".$article->id."&campaignId=".$campaign->id."'>".$article->getFullName()."</a></td>";
                                echo    "<td>".$article->category."</td>";
                                echo    "<td>".$article->manufacturer."</td>";
                                echo    "<td>".$article->model."</td>";
                                echo    "<td>".$article->stock."</td>";
                                echo    "<td>".$article->selling_price."</td>";
                                echo    "<td><input id='real_price_".$article->id."' onchange='OnRealPriceChanged(\"".$campaign->id."\", \"".$article->id."\", this.value)' type='number' ".$enabled." value='".$article->real_price."'></input></td>";
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
                    <input type="submit" class="alt_btn" name="addarticlestocampaign" value="Weiter zur Finalisierung" />
                </div>
            </footer>
            
        </article>

    </form>
    
    <div class="spacer clear"></div>
    
</section>

