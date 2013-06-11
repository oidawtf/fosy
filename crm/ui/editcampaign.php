<?php

controller::checkAuthentication();

if (isset($_GET['campaignId']))
    $campaignId = $_GET['campaignId'];
else
    $campaignId = controller::createCampaign();

?>

<section id="main" class="column">
    
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=addcustomerstocampaign&campaignId=<?php echo $campaignId; ?>">

        <article class="module width_full">
            <header>
                <h3 class="tabs_involved">Grunddaten erfassen</h3>
            </header>

            <div class="module_content">

                <fieldset class="clear">
                    <h4><label>Grunddaten</label></h4>
                    <div class="clear" style="float: left; margin-bottom: 10px;">
                        <label>* Name</label>
                        <textarea name="name" required="1" maxlength="255" rows=5"></textarea>
                    </div>
                    <div style="float: left; margin-bottom: 10px;">
                        <label>* Ziel</label>
                        <textarea name="goal" required="1" maxlength="255" rows=5"></textarea>
                    </div>
                    <div style="float: left; margin-bottom: 10px;">
                        <label>* Beschreibung</label>
                        <textarea name="description" required="1" maxlength="255" rows=5"></textarea>
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
                                <td><input name="budget" required="1" type="text" style="width:90%" /></td>
                                <td><input name="date_from" required="1" type="date" style="width:90%" /></td>
                                <td><input name="date_to" required="1" type="date" style="width:90%" /></td>
                                <td>
                                    <select name="medium" style="width:90%;">
                                        <option value="email">Newsletter</option>
                                        <option value="address">Serienbrief</option>
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
                    <input type="button" onclick="javascript:history.back()" value="Abbrechen" />
                </div>
            </footer>
            
        </article>

        <div class="spacer clear"></div>
    
    </form>
</section>
