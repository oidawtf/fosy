<?php

class page {
    
    private $id;
    private $title;
    private $url;
    private $parents;
    
    public function __construct($id, $title, $url, $parents = NULL) {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
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
    
    public function getParents() {
        return $this->parents;
    }
}

?>
