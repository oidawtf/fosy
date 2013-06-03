<?php

@controller::checkAuthentication();

?>

<section id="main" class="column" style="height: 90%;">
    
    <article class="module width_full">
        <header>
            <h3 class="tabs_involved">Kundensuche</h3>
        </header>
        <form class="quick_search" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="content" value="maintaincustomer" />
            <input type="text" name="search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="Geben Sie hier die Suchkriterien ein...">
            <input type="submit" value="Suchen" />
        </form>
    </article>
    
    <article class="module width_full">
        
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
                            <th class="header">Titel</th>
                            <th class="header">Vorname</th>
                            <th class="header">Nachname</th>
                            <th class="header">Benutzername</th>
                            <th class="header">Geburtsdatum</th>
                        </tr> 
                    </thead>
                    <tbody>
                        
                        <?php
                        
                        if (isset($_GET['search']))
                            $customers = controller::getCustomers($_GET['search']);
                        else
                            $customers = controller::getCustomers("");
                        
                        foreach ($customers as $customer) {
                            echo "<tr>";
                            echo    "<td><a href='".$_SERVER['PHP_SELF']."?content=customerdetails&id=".$customer->id."'>".$customer->firstname." ".$customer->lastname."</a></td>";
                            echo    "<td>".$customer->title."</td>";
                            echo    "<td>".$customer->firstname."</td>";
                            echo    "<td>".$customer->lastname."</td>";
                            echo    "<td>".$customer->username."</td>";
                            echo    "<td>".$customer->getBirthdate()."</td>";
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
                        
                        $customers = controller::getCustomers("");
                        
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