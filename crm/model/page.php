<?php

class page {
    
    private $id;
    private $title;
    private $url;
    private $GETId;
    private $parents;
    
    public function __construct($id, $title, $url, $GETId = NULL, $parents = NULL) {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
        $this->GETId = $GETId;
        $this->parents = $parents;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }
    
    public function getUrl() {
        return $this->url;
    }
    
    public function computeIdParameter() {
        if ($this->GETId == NULL || !isset($_GET[$this->GETId]))
            return "";
        
        return "&".$this->GETId."=".$_GET[$this->GETId];
        //return '&id='.$_GET['id'];
    }
    
    public function getParents() {
        return $this->parents;
    }
}

?>
