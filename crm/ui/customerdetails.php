<?php

@controller::checkAuthentication();

if (isset($_GET['id']))
    $customer = controller::getCustomer($_GET['id']);

echo $customer->firstname." ".$customer->lastname;

?>
