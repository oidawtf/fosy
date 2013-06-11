<?php

class controllerBase {
    
    private static $dataService;
    
    protected static function getDataService() {
        if (empty(controllerBase::$dataService))
            controllerBase::$dataService = new dbAccess();
         
        return controllerBase::$dataService;
    }
    
}

?>
