<?php

class page {
    
    private $id;
    private $title;
    private $url;
    private $needsId;
    private $parents;
    
    public function __construct($id, $title, $url, $needsId = false, $parents = NULL) {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
        $this->needsId = $needsId;
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
        if (isset($_GET['id']) && $this->needsId)
            return '&id='.$_GET['id'];
        
        return "";
    }
    
    public function getParents() {
        return $this->parents;
    }
}

?>
