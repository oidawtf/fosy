<?php

controller::checkAuthentication();

?>

<script type="text/javascript">
    
    function OnReloadCustomers(select) {
        OnLoadCustomers(select.options[select.selectedIndex].value);
    }
    
    function OnLoadCustomers(medium) {
        var xmlhttp = getXmlHttpRequest();
        var url = "ui/getCustomers.php";
        var params = "medium=" + medium;

        xmlhttp.open("POST", url, true);

        xmlhttp.onreadystatechange = function()
        {
            if (xmlhttp.readyState===4 && xmlhttp.status===200)
                document.getElementById("customers").innerHTML=xmlhttp.responseText;
        };

        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.setRequestHeader("Content-length", params.length);
        xmlhttp.setRequestHeader("Connection", "close");

        xmlhttp.send(params);
    }
    
</script>

<section id="main" class="column">
    
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=home">

        <article class="module width_full">
            <header>
                <h3 class="tabs_involved">Kampagne erfassen</h3>
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
                                <td><input name=date_from" required="1" type="date" style="width:90%" /></td>
                                <td><input name="date_to" required="1" type="date" style="width:90%" /></td>
                                <td>
                                    <select name="medium" style="width:90%;" onchange="OnReloadCustomers(this)">
                                        <option value="email">Newsletter</option>
                                        <option value="address">Serienbrief</option>
                                    </select>
                                    <script type="text/javascript">
                                        OnLoadCustomers('email');
                                    </script>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>

            </div>
        </article>

        <article class="module width_half">
            <header>
                <h3 class="tabs_involved">Kundenauswahl</h3>
            </header>

            <div class="module_content">
                <div id="customers"></div>
            </div>
        </article>

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
                    <tbody>

                    </tbody>
                </table>
            </div>
        </article>

        <div class="spacer clear"></div>
        
        <footer>
            <div class="submit_link">
                <input type="submit" class="alt_btn" name="createcampaign" value="Speichern" />
                <input type="button" onclick="javascript:history.back()" value="Abbrechen" />
            </div>
        </footer>
    
    </form>
</section>
