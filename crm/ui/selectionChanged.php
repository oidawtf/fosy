<?php

require_once '../../shared/authenticationController.php';
require_once '../includes.php';

authenticationController::checkAuthentication();

controller::updateCampaignRelations();

?>
