<?php

class dbAccess {
    
//  local DB    
    const host = "localhost";
    const db = "fosy";
    const user = "fosy";
    const password = "fosyPassword";
    
//  remote DB
//    const host = "";
//    const db = "";
//    const user = "";
//    const password = "";
  
    public function __construct() {
    }
    
    private function openConnection()
    {
         $connection = mysql_connect(self::host, self::user, self::password) or die("cannot connect");

         if (mysqli_connect_errno($connection))
         {
             printf("Connect failed: %s\n", mysqli_connect_error());
             exit();
         }
         
         mysql_select_db(self::db) or die("cannot connect");
         
         return $connection;
    }
    
    private function closeConnection($buffer) {
        mysql_free_result($buffer);
        mysql_close();  
    }
    
    private function format($input)
    {
        $input = stripslashes($input);
        $input = mysql_real_escape_string($input);
        return $input;
    }
    
    public function checkCredentials($username, $password) {
        $this->openConnection();
        
        $username = $this->format($username);
        $password = $this->format($password);
        $password = md5($password);
        
        // Hier query auslagern in $this->queries["select"]
        $query = mysql_query("SELECT * FROM person WHERE username='$username' and password='$password'");

        $result = mysql_num_rows($query);
        $this->closeConnection($query);
        
        return $result;
    }
    
    public function isUserRegistered($username) {
        $this->openConnection();

        $username = $this->format($username);
        
        $query = mysql_query("SELECT * FROM user WHERE email='$username'");
        
        $result = mysql_num_rows($query);

        $this->closeConnection($query);
        
        if ($result > 0)
            return true;
        else
            return false;
    }
    
    public function getCustomers($search)
    {
        $this->openConnection();

        $search = $this->format($search);
        
        if ($search == "")
            $query = mysql_query("select * from person where is_customer = 1;");
        else
            $query = mysql_query("select * from person where (username like '%".$search."%' OR firstname like '%".$search."%' OR lastname like '%".$search."%') AND is_customer = 1" );
        
        $result = array();
        while ($row = mysql_fetch_assoc($query))
        {
            $person = new person();
            $person->id = $row['id'];
            $person->username = $row['username'];
            $person->firstname = $row['firstname'];
            $person->lastname = $row['lastname'];
            $person->title = $row['title'];
            $person->birthdate = $row['birthdate'];
            $person->street = $row['street'];
            $person->housenumber = $row['housenumber'];
            $person->stiege = $row['stiege'];
            $person->doornumber = $row['doornumber'];
            $person->city = $row['city'];
            $person->zip = $row['zip'];
            $person->country = $row['country'];
            $person->phone = $row['phone'];
            $person->fax = $row['fax'];
            $person->email = $row['email'];
            $person->personnel_number = $row['personnel_number'];
            $person->hiredate = $row['hiredate'];
            $person->posistion = $row['position'];
            $person->is_distributor = $row['is_distributor'];
            $person->is_customer = $row['is_customer'];
            $person->is_employee = $row['is_employee'];
            $result[] = $person;
        }
        
        $this->closeConnection($query);
        
        return $result;
    }
    
    public function insertCustomer($firstname, $lastname, $title, $birthdate, $street, $housenumber, $stiege, $doornumber, $zip, $city, $country, $phone, $fax, $email) {
        $this->openConnection();

        $firstname = $this->format($firstname);
        $lastname = $this->format($lastname);
        $title = $this->format($title);
        $birthdate = $this->format($birthdate);
        $street = $this->format($street);
        $housenumber = $this->format($housenumber);
        $stiege = $this->format($stiege);
        $doornumber = $this->format($doornumber);
        $zip = $this->format($zip);
        $city = $this->format($city);
        $country = $this->format($country);
        $phone = $this->format($phone);
        $fax = $this->format($fax);
        $email = $this->format($email);

        mysql_query("
            INSERT INTO person (firstname, lastname, title, birthdate, street, housenumber, stiege, doornumber, zip, city, country, phone, fax, email, is_customer)
            VALUES (
                '".$firstname."',
                '".$lastname."',
                '".$title."',
                '".$birthdate."',
                '".$street."',
                '".$housenumber."',
                '".$stiege."',
                '".$doornumber."',
                '".$zip."',
                '".$city."',
                '".$country."',
                '".$phone."',
                '".$fax."',
                '".$email."',
                '1'
                    )
                ");
        
        mysql_close();
    }
    
    public function updateCustomer($id, $firstname, $lastname, $title, $birthdate, $street, $housenumber, $stiege, $doornumber, $zip, $city, $country, $phone, $fax, $email) {
        $this->openConnection();

        $id = $this->format($id);
        $firstname = $this->format($firstname);
        $lastname = $this->format($lastname);
        $title = $this->format($title);
        $birthdate = $this->format($birthdate);
        $street = $this->format($street);
        $housenumber = $this->format($housenumber);
        $stiege = $this->format($stiege);
        $doornumber = $this->format($doornumber);
        $zip = $this->format($zip);
        $city = $this->format($city);
        $country = $this->format($country);
        $phone = $this->format($phone);
        $fax = $this->format($fax);
        $email = $this->format($email);
        
        mysql_query("
                UPDATE TABLE person
                SET
                firstname = '".$firstname."',
                lastname = '".$lastname."',
                title = '".$title."',
                birthdate = '".$birthdate."',
                street = '".$street."',
                housenumber = '".$housenumber."',
                stiege = '".$stiege."',
                doornumber = '".$doornumber."',
                zip = '".$zip."',
                city = '".$city."',
                country = '".$country."',
                phone = '".$phone."',
                fax = '".$fax."',
                email = '".$email."',
                ");
        
        mysql_close();
    }
}

?>
