<?php

authenticationController::checkAuthentication();

if (!isset($_GET['campaignId']))
    return;

$campaignId = $_GET['campaignId'];

if (isset($_POST['editcampaign']))
    $campaign = controller::editCampaign($campaignId);
else
    $campaign = controller::getCampaign($campaignId);

$articles = controller::getArticlessByCampaign($campaign);

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
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=finalizecampaign&campaignId=<?php echo $campaign->id; ?>">
        <article class="module width_full">
            
            <header>
                <h3 class="tabs_involved">Artikelauswahl</h3>
            </header>

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
                    
                    ?>
                </tbody>
            </table>
            
            <footer>
                <div class="submit_link">
                    <input type="submit" class="alt_btn" name="addarticlestocampaign" value="Weiter zur Finalisierung" />
                </div>
            </footer>
            
        </article>

    </form>
    
    <div class="spacer clear"></div>
    
</section>

