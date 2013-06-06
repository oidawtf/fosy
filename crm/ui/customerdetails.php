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
                <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="float:left; margin-right: 10px;">
                    <input type="hidden" name="content" value="editcustomer" />
                    <input type="hidden" name="id" value="<?php echo $customer->id; ?>" />
                    <input type="submit" value="Bearbeiten" />
                </form>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?content=showcustomers" style="float:left;">
                    <input type="hidden" name="deletecustomer" value="" />
                    <input type="hidden" name="id" value="<?php echo $customer->id; ?>" />
                    <input type="submit" value="L&ouml;schen" />
                </form>
            </div>
        </footer>
    </article>
    
    <article class="module width_half">
        <header>
            <h3 class="tabs_involved">Anfragen</h3>
        </header>
        
        <div class="module_content">
            <table cellspacing="0" class="tablesorter" style="margin: -15px -20px 0 -20px; width: 107%;">
                <thead>
                    <tr> 
                        <th class="header">Betreff</th>
                        <th class="header">Text</th>
                        <th class="header">Status</th>
                        <th class="header">Datum</th>
                    </tr> 
                </thead>
                <tbody>

                    <?php

                    $requests = controller::getRequests($customer->id);

                    foreach ($requests as $request) {
                        $betreff = $request->type;
                        if ($request->article != "")
                            $betreff = $betreff." zu ".$request->article;
                        echo "<tr>";
                        echo    "<td><a href='".$_SERVER['PHP_SELF']."?content=showrequest&id=".$customer->id."&requestid=".$request->id."'>".$betreff."</a></td>";
                        echo    "<td>".$request->getTextTrimmed()."</td>";
                        echo    "<td>".$request->status."</td>";
                        echo    "<td>".$request->date."</td>";
                        echo "</tr>";
                    }

                    ?>

                </tbody>
            </table>
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