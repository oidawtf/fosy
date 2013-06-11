<?php

authenticationController::checkAuthentication();

?>

<section id="main" class="column" style="height: 90%;">
    
    <article class="module width_full" style="float:left">
        
        <header>
            <h3 class="tabs_involved">Anfragen</h3>
        </header>

        <div class="tab_container">
            <div class="tab_content" style="display: block;">
                <table cellspacing="0" class="tablesorter">
                    <thead>
                        <tr>
                            <th class="header">Betreff</th>
                            <th class="header">Text</th>
                            <th class="header" style="width: 150px;">Kunde</th>
                            <th class="header" style="width: 100px;">Status</th>
                            <th class="header" style="width: 100px;">Datum</th>
                            <th class="header" style="width: 160px;">Aktionen</th>
                        </tr> 
                    </thead>
                    <tbody>
                        
                        <?php
                        
                        $requests = controller::getRequestsByUsername();
                        
                        foreach ($requests as $request) {
                            echo "<tr>";
                            echo    "<td><a href='".$_SERVER['PHP_SELF']."?content=requestdetails&customerId=".$request->customerId."&requestId=".$request->id."'>".$request->getBetreff()."</a></td>";
                            echo    "<td>".$request->getTextTrimmed(400)."</td>";
                            echo    "<td><a href='".$_SERVER['PHP_SELF']."?content=customerdetails&customerId=".$request->customerId."'>".$request->customer."</a></td>";
                            echo    "<td>".$request->status."</td>";
                            echo    "<td>".$request->getDate()."</td>";
                            echo    "<td>";
                            echo        "<form method='GET' action='".$_SERVER['PHP_SELF']."' style='float:left; margin-right: 10px;'>";
                            echo            "<input type='hidden' name='content' value='editrequest' />";
                            echo            "<input type='hidden' name='customerId' value='".$request->customerId."' />";
                            echo            "<input type='hidden' name='requestId' value='".$request->id."' />";
                            echo            "<input type='image' title='Bearbeiten' src='images/icn_edit.png'>";
                            if ($request->typeId == 3)
                                echo        "<a href='../auftragsMgmt/index.php?content=AngebotErstellen&customerId=".$request->customerId."&requestId=".$request->id."'>Angebot erstellen</a>";
                            if ($request->typeId == 4)
                                echo        "<a href='../auftragsMgmt/index.php?content=AuftragErstellen&customerId=".$request->customerId."&requestId=".$request->id."' style='margin-left: 10px;'>Autrag erstellen</a>";
                            echo        "</form>";
                            echo    "</td>";
                            echo "</tr>";
                        }
                        
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
        
    </article>
    
    <div class="spacer clear"></div>
    
</section>
