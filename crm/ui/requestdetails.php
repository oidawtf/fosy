<?php

authenticationController::checkAuthentication();
authenticationController::checkAuthorization();

if (isset($_GET['requestId']))
    $request = controller::getRequestById($_GET['requestId']);

?>

<section id="main" class="column" style="height: 90%;">
    <article class="module width_full">
        <header>
            <h3>Kundenanfrage - Details - Id: <?php echo $request->id; ?></h3>
        </header>

        <div class="module_content">
            <fieldset style="padding: 10px">
                <h4><label style="width: 90%;"><?php echo $request->getBetreff(); ?></label></h4>
                <table class="clear">
                    <tbody>
                        <tr>
                            <td><label>Kunde</label></td>
                            <td><label>Sachbearbeiter</label></td>
                            <td><label>Status</label></td>
                            <td><label>Datum</label></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><a href='<?php echo $_SERVER['PHP_SELF']."?content=customerdetails&customerId=".$request->customerId; ?>'><?php echo $request->customer; ?></a></td>
                            <td><?php echo $request->responsible_username." - ".$request->responsible_user ?></td>
                            <td><?php echo $request->status; ?></td>
                            <td><?php echo $request->getDate(); ?></td>
                        </tr>
                    </tbody>
                </table>
                <p><?php echo $request->text; ?></p>
            </fieldset>
        </div>
        
        <footer>
            <div class="submit_link">
                <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="content" value="editrequest" />
                    <input type="hidden" name="customerId" value="<?php echo $request->customerId; ?>" />
                    <input type="hidden" name="requestId" value="<?php echo $request->id; ?>" />
                    <input type="submit" value="Bearbeiten" />
                </form>
            </div>
        </footer>
    </article>
    
    <div class="spacer clear"></div>
    
</section>