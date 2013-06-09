<?php

class request {

    const MAXLENGTH = 50;
    
    public $id;
    public $customerId;
    public $customer;
    public $responsible_userId;
    public $responsible_user;
    public $responsible_username;
    public $typeId;
    public $type;
    public $article_id;
    public $article_model;
    public $article_category_id;
    public $article_category;
    public $manufacturer_id;
    public $manufacturer;
    public $text;
    public $status;
    public $date;
    
    public function getIdFormatted() {
        if ($this->id == "")
            return "";
        else
            return " - Id ".$this->id;
    }
    
    public function getBetreff() {
        $betreff = $this->type;
        if ($this->getArticle() != "")
            $betreff = $betreff." zu ".$this->getArticle();
        
        return $betreff;
    }
    
    public function getArticle() {
        return $this->manufacturer." ".$this->article_model;
    }
    
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
