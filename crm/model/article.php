<?php

class article {
    
    public $id;
    public $category_id;
    public $category;
    public $manufacturer_id;
    public $manufacturer;
    public $model;
    public $description;
    public $picture;
    public $stock;
    public $purchase_price;
    public $selling_price;
    public $real_price;
    public $tax_rate;
    
    public $isSelected;
    
    public function getFullName() {
        return $this->manufacturer." ".$this->model;
    }
    
}

?>
