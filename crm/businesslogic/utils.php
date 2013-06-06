<?php

class utils {
    
    public static function ConvertDate($date) {
        if ($date == NULL)
            return "";
        
        return date("j F Y", strtotime($date));
    }
    
}

?>
