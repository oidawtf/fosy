<?php

authenticationController::checkAuthentication();
authenticationController::checkAuthorization();

if (isset($_GET['campaignId']))
    $campaign = controller::getCampaign($_GET['campaignId']);
else
    $campaign = controller::createCampaign();

?>

<script type="text/javascript">
    $(function() {
        $( "#date_from" ).datepicker();
        $( "#date_to" ).datepicker();
    });
</script>

<section id="main" class="column">
    
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=addcustomerstocampaign&campaignId=<?php echo $campaign->id; ?>">

        <article class="module width_full">
            <header>
                <h3 class="tabs_involved">Grunddaten erfassen</h3>
            </header>

            <div class="module_content">

                <fieldset class="clear">
                    <h4><label>Grunddaten</label></h4>
                    <div class="clear" style="float: left; margin-bottom: 10px;">
                        <label>* Name</label>
                        <textarea name="name" required="1" maxlength="255" rows=5"><?php echo $campaign->name; ?></textarea>
                    </div>
                    <div style="float: left; margin-bottom: 10px;">
                        <label>* Ziel</label>
                        <textarea name="goal" required="1" maxlength="255" rows=5"><?php echo $campaign->goal; ?></textarea>
                    </div>
                    <div style="float: left; margin-bottom: 10px;">
                        <label>* Beschreibung</label>
                        <textarea name="description" required="1" maxlength="1000" rows=5"><?php echo $campaign->description; ?></textarea>
                    </div>
                    <table class="clear">
                        <tbody>
                            <tr>
                                <td><label>* Budget</label></td>
                                <td><label>* Von</label></td>
                                <td><label>* Bis</label></td>
                                <td><label>Medium</label></td>
                            </tr>
                            <tr>
                                <td><input name="budget" required="1" type="text" value="<?php echo $campaign->budget; ?>" style="width:90%" /></td>
                                <td><input id="date_from" name="date_from" required="1" type="date" value="<?php echo $campaign->getDateFrom(); ?>" style="width:90%" /></td>
                                <td><input id="date_to" name="date_to" required="1" type="date" value="<?php echo $campaign->getDateTo(); ?>" style="width:90%" /></td>
                                <td>
                                    <select name="medium" style="width:90%;">
                                        <?php
                                        foreach (controller::getMediums() as $item) {
                                            if ($campaign->medium == $item['id'])
                                                $selected = "selected='selected'";
                                            else
                                                $selected = "";                          

                                            echo "<option ".$selected." value='".$item['id']."'>".$item['name']."</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>

            </div>
            
            <footer>
                <div class="submit_link">
                    <input type="submit" class="alt_btn" name="editcampaign" value="Weiter zur Kundenauswahl" />
                    <input type="button" onclick="javascript:history.back();" value="Abbrechen" />
                </div>
            </footer>
            
        </article>

        <div class="spacer clear"></div>
    
    </form>
</section>
