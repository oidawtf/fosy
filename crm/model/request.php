<?php

class request {

    const MAXLENGTH = 50;
    
    public $id;
    public $customerId;
    public $customer;
    public $responsible_userId;
    public $responsible_user;
    public $responsible_username;
    public $type;
    public $article; // Manufacturer + Model
    public $text;
    public $status;
    public $date;
    
    public function getTextTrimmed($length = NULL) {
        if ($length == NULL)
            $length = self::MAXLENGTH;
        
        if (strlen($this->text) > $length)
            return substr($this->text, 0, $length - 3)."...";
        
        return $this->text;
    }
    
    public function getDate() {
        return utils::ConvertDate($this->date);
    }
}

?>
