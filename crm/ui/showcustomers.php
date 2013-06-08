<?php

@controller::checkAuthentication();

if (isset($_POST['createcustomer']))
    controller::createCustomer();
if (isset($_POST['editcustomer']))
    controller::editCustomer();
if (isset($_POST['deletecustomer']))
    controller::deleteCustomer();

if (isset($_GET['search']))
    $customers = controller::getCustomers($_GET['search']);
else
    $customers = controller::getCustomers();

?>

<section id="main" class="column" style="height: 90%;">
    
    <article class="module width_full" style="float:left">
        
        <header>
            <h3 class="tabs_involved">Kunden</h3>
            <ul class="tabs">
                <li class="active"><a href="#tab1">Generell</a></li>
                <li><a href="#tab2">Erreichbarkeiten</a></li>
            </ul>
        </header>

        <div class="tab_container">
            <div class="tab_content" id="tab1" style="display: block;">
                <table cellspacing="0" class="tablesorter">
                    <thead>
                        <tr> 
                            <th class="header">Name</th>
                            <th class="header">Vorname</th>
                            <th class="header">Nachname</th>
                            <th class="header">Geburtsdatum</th>
                            <th class="header">Anzahl Anfragen</th>
                            <th class="header">Anzahl Angebote</th>
                            <th class="header">Anzahl Bestellungen</th>
                            <th class="header">Aktionen</th>
                        </tr> 
                    </thead>
                    <tbody>
                        
                        <?php
                        
                        foreach ($customers as $customer) {
                            echo "<tr>";
                            echo    "<td><a href='".$_SERVER['PHP_SELF']."?content=customerdetails&id=".$customer->id."'>".$customer->getFullName()."</a></td>";
                            echo    "<td>".$customer->firstname."</td>";
                            echo    "<td>".$customer->lastname."</td>";
                            echo    "<td>".$customer->getBirthdate()."</td>";
                            echo    "<td>".$customer->requests."</td>";
                            echo    "<td>".$customer->offers."</td>";
                            echo    "<td>".$customer->orders."</td>";
                            echo    "<td>";
                            echo        "<form method='GET' action='".$_SERVER['PHP_SELF']."' style='float:left; margin-right: 10px;'>";
                            echo            "<input type='hidden' name='content' value='editcustomer' />";
                            echo            "<input type='hidden' name='id' value='".$customer->id."' />";
                            echo            "<input type='image' title='Bearbeiten' src='images/icn_edit.png'>";
                            echo        "</form>";
                            echo        "<form method='POST' action='".$_SERVER['PHP_SELF']."?content=showcustomers' style='float:left;'>";
                            echo            "<input type='hidden' name='deletecustomer' value='' />";
                            echo            "<input type='hidden' name='id' value='".$customer->id."' />";
                            echo            "<input type='image' title='L&ouml;schen' src='images/icn_trash.png'>";
                            echo        "</form>";
                            echo    "</td>";
                            echo "</tr>";
                        }
                        
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <div id="tab2" class="tab_content" style="display: none;">
                <table cellspacing="0" class="tablesorter">
                    <thead>
                        <tr> 
                            <th class="header">Name</th>
                            <th class="header">Telefon</th>
                            <th class="header">Fax</th>
                            <th class="header">email</th>
                            <th class="header">Adresse</th>
                            <th class="header">Stadt</th>
                            <th class="header">ZIP Code</th>
                            <th class="header">Land</th>
                        </tr> 
                    </thead>
                    <tbody>
                        
                        <?php
                        
                        foreach ($customers as $customer) {
                            echo "<tr>";
                            echo    "<td><a href='".$_SERVER['PHP_SELF']."?content=customerdetails&id=".$customer->id."'>".$customer->firstname." ".$customer->lastname."</a></td>";
                            echo    "<td>".$customer->phone."</td>";
                            echo    "<td>".$customer->fax."</td>";
                            echo    "<td><a href='mailto:".$customer->email."'>".$customer->email."</a></td>";
                            echo    "<td>".$customer->getAddress()."</td>";
                            echo    "<td>".$customer->city."</td>";
                            echo    "<td>".$customer->zip."</td>";
                            echo    "<td>".$customer->country."</td>";
                            echo "</tr>";
                        }
                        
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
        
    </article>
</section>