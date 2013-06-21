<?php

authenticationController::checkAuthentication();
authenticationController::checkAuthorization();

if (!isset($_GET['campaignId']))
    return;

$campaignId = $_GET['campaignId'];

$customers = controller::getSelectedCustomers($campaignId);

?>

<section id="main" class="column" style="height: 90%;">
    <article class="module width_full">

        <header>
            <h3 class="tabs_involved">Kampagnen-Elemente drucken</h3>
        </header>

        <div class="table-wrapper">
            <div class="table-scroll">
                <table cellspacing="0" class="tablesorter">
                    <thead>
                        <tr>
                            <th class="header">Name</th>
                            <th class="header">email</th>
                            <th class="header"></th>
                        </tr>
                    </thead>
                    <tbody style="overflow: scroll; height: 300px;">
                        <?php

                        foreach ($customers as $customer) {
                            echo "<tr>";
                            echo    "<td style='width: 100px;'>".$customer->getFullName()."</td>";
                            echo    "<td><a href='mailto:".$customer->email."'>".$customer->email."</a></td>";
                            echo    "<td><a href='ui/createCampaignPDF.php?campaignId=".$campaignId."&customerId=".$customer->id."' target='_blank'>PDF</a></td>";
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
