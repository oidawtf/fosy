<?php

authenticationController::checkAuthentication();
authenticationController::checkAuthorization();

if (isset($_POST['createrequest']) && isset($_GET['customerId']))
    controller::createRequest($_GET['customerId']);

if (isset($_POST['editrequest']) && isset($_POST['requestId']))
    controller::editRequest($_POST['requestId']);

if (!isset($_GET['customerId']))
    return;

$customerId = $_GET['customerId'];

$customer = controller::getCustomer($customerId);
$orders = controller::getOrders($customerId);
$offers = controller::getOffers($customerId);

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
                            <td><?php echo $customer->getBirthdate(); ?></td>
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
                    <input type="hidden" name="customerId" value="<?php echo $customer->id; ?>" />
                    <input type="submit" value="Bearbeiten" />
                </form>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?content=showcustomers" style="float:left;">
                    <input type="hidden" name="deletecustomer" value="" />
                    <input type="hidden" name="customerId" value="<?php echo $customer->id; ?>" />
                    <input type="submit" value="L&ouml;schen" />
                </form>
            </div>
        </footer>
    </article>
    
    <article class="module width_full">
        <header>
            <h3 class="tabs_involved">Aktivit&auml;ten</h3>
            <ul class="tabs">
                <li class="active"><a href="#tab1">Anfragen</a></li>
                <li><a href="#tab2">Bestellungen</a></li>
                <li><a href="#tab3">Angebote</a></li>
            </ul>
        </header>
        
        <div class="tab_container table-wrapper">
            
            <div id="tab1" class="tab_content table-scroll" style="height: 400px; display: block;">
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

                        <?php

                        $requests = controller::getRequestsByCustomer($customer->id);

                        foreach ($requests as $request) {
                            echo "<tr>";
                            echo    "<td><a href='".$_SERVER['PHP_SELF']."?content=requestdetails&customerId=".$customer->id."&requestId=".$request->id."'>".$request->getBetreff()."</a></td>";
                            echo    "<td>".$request->getTextTrimmed(200)."</td>";
                            echo    "<td>".$request->responsible_user."</td>";
                            echo    "<td>".$request->status."</td>";
                            echo    "<td>".$request->getDate()."</td>";
                            echo "</tr>";
                        }

                        ?>

                    </tbody>
                </table>
            </div>
            
            <div id="tab2" class="tab_content table-scroll" style="height: 400px; display: none;">
                <table cellspacing="0" class="tablesorter">
                    <thead>
                        <tr>
                            <th class="header">Id</th>
                            <th class="header">Nummer</th>
                            <th class="header" style="width: 120px;">Datum</th>
                        </tr> 
                    </thead>
                    <tbody>

                        <?php
                        
                        foreach ($orders as $order) {
                            echo "<tr>";
                            echo    "<td>".$order['id']."</td>";
                            echo    "<td>".$order['orderNumber']."</td>";
                            echo    "<td>".utils::ConvertDate($order['orderDate'])."</td>";
                            echo "</tr>";
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        
            <div id="tab3" class="tab_content table-scroll" style="height: 400px; display: none;">
                <table cellspacing="0" class="tablesorter">
                    <thead>
                        <tr>
                            <th class="header">Id</th>
                            <th class="header">Nummer</th>
                            <th class="header" style="width: 120px;">Datum</th>
                            <th class="header" style="width: 120px;">G&uuml;ltig ab</th>
                            <th class="header" style="width: 120px;">G&uuml;ltig bis</th>
                        </tr> 
                    </thead>
                    <tbody>

                        <?php

                        foreach ($offers as $offer) {
                            echo "<tr>";
                            echo    "<td>".$offer['id']."</td>";
                            echo    "<td>".$offer['number']."</td>";
                            echo    "<td>".utils::ConvertDate($offer['date'])."</td>";
                            echo    "<td>".utils::ConvertDate($offer['valid_from'])."</td>";
                            echo    "<td>".utils::ConvertDate($offer['valid_until'])."</td>";
                            echo "</tr>";
                        }

                        ?>

                    </tbody>
                </table>
            </div>
            
        </div>
        
        <footer>
            <div class="submit_link">
                <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="content" value="createrequest" />
                    <input type="hidden" name="customerId" value="<?php echo $customer->id; ?>" />
                    <input type="submit" value="Anfrage erfassen" />
                </form>
            </div>
        </footer>
    </article>
    
    <div class="spacer clear"></div>
    
</section>