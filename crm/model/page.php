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
    
    public function getParameter() {
        if ($this->GETId == NULL || !isset($_GET[$this->GETId]))
            return NULL;
        
        return array($this->GETId => $_GET[$this->GETId]);
    }
    
    public function computeIdParameter() {
        $parameters = array();
        
        if ($this->parents != NULL)
            foreach ($this->parents as $key)
                $this->addParameter($parameters, $key);

        $this->addParameter($parameters, $this->id);
        $result = "";
        foreach ($parameters as $key => $value)
            $result = $result."&".$key."=".$value;
        
        return $result;
    }
    
    private function addParameter(&$parameters, $key) {
        $newParameter = controller::getContentItem($key)->getParameter();
        if ($newParameter != NULL)
            if (!array_key_exists(key($newParameter), $parameters))
                $parameters[key($newParameter)] = $newParameter[key($newParameter)];
        
        return $parameters;
    }
    
    public function getParents() {
        return $this->parents;
    }
}

?>
