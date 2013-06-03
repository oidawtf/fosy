<?php

class person {
    
    public $id;
    //public $fk_department_id;
    public $firstname;
    public $lastname;
    public $username;
    //public $password;
    public $title;
    public $street;
    public $housenumber;
    public $stiege;
    public $doornumber;
    public $city;
    public $zip;
    public $country;
    public $phone;
    public $fax;
    public $email;
    public $birthdate;
    public $personnel_number;
    public $hiredate;
    public $posistion;
    public $is_distributor;
    public $is_customer;
    public $is_employee;
    
    public function getAddress() {
        $result = $this->street." ".$this->housenumber;
        
        if ($this->stiege != "")
            $result = $result."/".$this->stiege;
        
        if ($this->doornumber != "")
            $result = $result."/".$this->doornumber;
            
        return $result;
    }
    
    public function getBirthdate() {
        if ($this->birthdate == NULL)
            return "";
        
        return date("j F Y", strtotime($this->birthdate));
    }
    
}

?>
