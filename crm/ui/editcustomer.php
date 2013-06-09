<?php

@controller::checkAuthentication();

if (isset($_GET['id'])) {
    $customer = controller::getCustomer($_GET['id']);
    $command = 'editcustomer';
}
else {
    $customer = new person();
    $command = 'createcustomer';
}

?>

<section id="main" class="column" style="height: 90%;">
    
    <article class="module width_full">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=showcustomers">
        
            <header>
                <h3 class="tabs_involved">Kunden bearbeiten<?php echo $customer->getIdFormatted(); ?></h3>
            </header>
        
            <div class="module_content">
                <fieldset style="padding: 10px">
                    <h4><label>Per&ouml;nlich</label></h4>
                    <table class="clear">
                        <tbody>
                            <tr>
                                <td><label>* Vorname</label></td>
                                <td><label>* Nachname</label></td>
                                <td><label>Titel</label></td>
                                <td><label>Geburtsdatum</label></td>
                            </tr>
                            <tr>
                                <td><input name="firstname" required="1" type="text" style="width:90%" value="<?php echo $customer->firstname; ?>" /></td>
                                <td><input name="lastname" required="1" type="text" style="width:90%" value="<?php echo $customer->lastname; ?>" /></td>
                                <td><input name="title" type="text" style="width:90%" value="<?php echo $customer->title; ?>" /></td>
                                <td><input name="birthdate" type="date" style="width:90%" value="<?php echo $customer->birthdate; ?>" /></td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>

                <fieldset class="clear" style="padding: 10px">
                    <h4><label>Adresse</label></h4>
                    <table class="clear">
                        <tbody>
                            <tr>
                                <td><label>* Stra&szlig;e</label></th>
                                <td><label style="width:95px">* Hausnummer</label></td>
                                <td><label style="width:65px">Stiege</label></td>
                                <td><label style="width:65px">T&uuml;r</label></td>
                            </tr>
                            <tr>
                                <td><input name="street" required="1" type="text" style="width:90%" value="<?php echo $customer->street; ?>" /></td>
                                <td><input name="housenumber" required="1" type="text" style="width:95px" value="<?php echo $customer->housenumber; ?>" /></td>
                                <td><input name="stiege" type="text" style="width:65px" value="<?php echo $customer->stiege; ?>" /></td>
                                <td><input name="doornumber" type="text" style="width:65px" value="<?php echo $customer->doornumber; ?>" /></td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="margin-top:20px">
                        <tbody>
                            <tr>
                                <td><label style="width:65px">* PLZ</label></td>
                                <td><label>* Ort</label></td>
                                <td><label>* Land</label></td>
                            </tr>
                            <tr>
                                <td><input name="zip" required="1" type="text" style="width:65px" value="<?php echo $customer->zip; ?>" /></td>
                                <td><input name="city" required="1" type="text" style="width:90%" value="<?php echo $customer->city; ?>" /></td>
                                <td><input name="country" required="1" type="text" style="width:90%" value="<?php echo $customer->country; ?>" /></td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>

                <fieldset class="clear" style="padding: 10px">
                    <h4><label>Erreichbarkeiten</label></h4>
                    <table class="clear">
                        <tbody>
                            <tr>
                                <td><label>Telefon</label></td>
                                <td><label>Fax</label></td>
                                <td><label>Email</label></td>
                            </tr>
                            <tr>
                                <td><input name="phone" type="text" style="width:90%" value="<?php echo $customer->phone; ?>" /></td>
                                <td><input name="fax" type="text" style="width:90%" value="<?php echo $customer->fax; ?>" /></td>
                                <td><input name="email" type="email" style="width:90%" value="<?php echo $customer->email; ?>" /></td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        
            <footer>
                <div class="submit_link">
                    <input type="hidden" name="id" value="<?php echo $customer->id; ?>" />
                    <input type="submit" class="alt_btn" name="<?php echo $command; ?>" value="Speichern" />
                    <input type="button" onclick="javascript:history.back()" value="Abbrechen" />
                </div>
            </footer>
        
        </form>
    </article>
    
    <div class="spacer clear"></div>
    
</section>