<?php

class utils {
    
    public static function ConvertDate($date) {
        if ($date == NULL)
            return "";
        
        return date("j F Y", strtotime($date));
    }
    
    public static function ConvertUser($user) {
        if ($user == NULL)
            return "";
        
        return $user['username']." - ".$user['firstname']." ".$user['lastname'];
    }
    
}

?>
