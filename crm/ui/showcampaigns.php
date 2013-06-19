<?php

authenticationController::checkAuthentication();

$campaigns = controller::getCampaigns();

var_dump($campaigns);

?>
