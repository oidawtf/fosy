<?php

class request {

    const MAXLENGTH = 50;
    
    public $id;
    public $type;
    public $article; // Manufacturer + Model
    public $text;
    public $status;
    public $date;
    
    public function getTextTrimmed() {
        if (strlen($this->text) > self::MAXLENGTH)
            return substr($this->text, 0, self::MAXLENGTH - 3)."...";
        
        return $this->text;
    }
    
    public function getDate() {
        return utils::ConvertDate($this->date);
    }
}

?>
