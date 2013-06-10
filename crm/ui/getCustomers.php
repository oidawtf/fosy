<?php

require '../includes.php';

controller::checkAuthentication();

if (!isset($_POST['medium']))
    return;

echo "<table cellspacing='0' class='tablesorter'>";
echo    "<thead>";
echo        "<tr>";
echo            "<th class='header'></th>";
echo            "<th class='header'>Name</th>";
echo            "<th class='header' style='width: 100px;'>Geburtsdatum</th>";
echo            "<th class='header'>ZIP Code</th>";
echo        "</tr>";
echo    "</thead>";

$customers = controller::getCustomersByMedium($_POST['medium']);

echo    "<tbody style='overflow: scroll; height: 300px;'>"; 
foreach ($customers as $customer) {
    echo     "<tr>";
    echo        "<td><input name='isSelected' type='checkbox' value='".$customer->id."'</td>";
    echo        "<td><a href='index.php?content=customerdetails&id=".$customer->id."'>".$customer->getFullName()."</a></td>";
    echo        "<td style='width: 100px;'>".$customer->getBirthdate()."</td>";
    echo        "<td>".$customer->zip."</td>";
    echo     "</tr>";
}
echo    "</tbody>";
echo "</table>";

?>
