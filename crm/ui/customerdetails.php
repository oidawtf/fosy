<?php

@controller::checkAuthentication();

if (isset($_GET['id']))
    $customer = controller::getCustomer($_GET['id']);

?>

<section id="main" class="column" style="height: 90%;">
    
    <article class="module width_full">
        <header>
            <h3 class="tabs_involved">Kundendetails<?php echo $customer->getIdFormatted(); ?></h3>
        </header>
        
        <div class="module_content">
            
            <fieldset style="padding: 10px">
                <h4><label><?php echo $customer->getFullName(); ?></label></h4>
                <table class="clear">
                    <tbody>
                        <tr>
                            <td><label>Geboren am</label></td>
                            <td><label>Adresse</label></td>
                            <td><label>Erreichbarkeiten</label></td>
                        </tr>
                        <tr>
                            <td><?php echo $customer->birthdate; ?></td>
                            <td><?php echo $customer->getAddress(); ?></td>
                            <td>Telefon: <?php echo $customer->phone; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><?php echo $customer->zip." ".$customer->city; ?></td>
                            <td>Fax: <?php echo $customer->fax; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><?php echo $customer->country; ?></td>
                            <td>Email: <a href="mailto:<?php echo $customer->email; ?>"><?php echo $customer->email; ?></a></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>
        
        <footer>
            <div class="submit_link">
                <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="content" value="editcustomer" />
                    <input type="hidden" name="id" value="<?php echo $customer->id; ?>" />
                    <input type="submit" value="Bearbeiten" />
                </form> 
            </div>
        </footer>
    </article>
    
    <article class="module width_half">
        <header>
            <h3 class="tabs_involved">Anfragen</h3>
        </header>
        
        <div class="module_content">
            
        </div>
        
        <footer>
            <div class="submit_link">
                <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="content" value="customerrequest" />
                    <input type="hidden" name="id" value="<?php echo $customer->id; ?>" />
                    <input type="submit" value="Anfrage erfassen" />
                </form>
            </div>
        </footer>
    </article>
    
    <article class="module width_half">
        <header>
            <h3 class="tabs_involved">Bestellungen</h3>
        </header>
        
        <div class="module_content">
            
        </div>
    </article>
    
</section>