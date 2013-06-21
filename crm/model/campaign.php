<?php

class campaign {

    const MAXLENGTHNAME = 50;
    const MAXLENGTHDESCRIPTION = 200;
    const MAXLENGTHGOAL= 50;
    
    public $id;
    public $name;
    public $description;
    public $goal;
    public $date_from;
    public $date_to;
    public $budget;
    public $medium;
    public $code;
    
    public $customers;
    public $articles;
    
    public function getNameTrimmed($length = NULL) {
        if ($length == NULL)
            $length = self::MAXLENGTHNAME;
        
        if (strlen($this->name) > $length)
            return substr($this->name, 0, $length - 3)."...";
        
        return $this->name;
    }
    
    public function getDescriptionTrimmed($length = NULL) {
        if ($length == NULL)
            $length = self::MAXLENGTHDESCRIPTION;
        
        if (strlen($this->description) > $length)
            return substr($this->description, 0, $length - 3)."...";
        
        return $this->description;
    }
    
    public function getGoalTrimmed($length = NULL) {
        if ($length == NULL)
            $length = self::MAXLENGTHGOAL;
        
        if (strlen($this->goal) > $length)
            return substr($this->goal, 0, $length - 3)."...";
        
        return $this->goal;
    }
    
    public function getDateFrom() {
        return utils::ConvertDate($this->date_from);
    }
    
    public function getDateTo() {
        return utils::ConvertDate($this->date_to);
    }
    
}

?>
