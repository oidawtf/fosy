<?php

class dbAccess {
    
//  local DB    
    const host = "localhost";
    const db = "etc";
    const user = "root";
    const password = "";
    
//  remote DB
//    const host = "mysqlsvr31.world4you.com";
//    const db = "oidawtfcomdb1";
//    const user = "oidawtfcom";
//    const password = "JDx0Z@M";
  
    private $queries = array(
        "select" => array(
            "event" => "select * from event",
            "booking" => "select * from booking"
        )
    );
    
    private $columns = array(
        "user" => array(
            "id" => "id",
            "firstname" => "firstname",
            "lastname" => "lastname",
            "password" => "password",
            "email" => "email",
            "isAdmin" => "is_admin"
        ),
        "event" => array(
            "id" => "id",
            "name" => "name",
            "date" => "date",
            "image" => "image",
            "description" => "description",
            "link" => "link",
            "type" => "type",
            "isMajor" => "is_major",
            "price" => "price"
        ),
    );
    
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
    
    public function getEvents($search)
    {
        $this->openConnection();

        $search = $this->format($search);
        
        if ($search == "")
            $query = mysql_query($this->queries["select"]["event"]);
        else
            $query = mysql_query("select * from event where name like '%".$search."%'");
        
        $result = array();
        while ($row = mysql_fetch_assoc($query))
        {
            $result[] = new event(
                    $row[$this->columns['event']['id']],
                    $row[$this->columns['event']['name']],
                    $row[$this->columns['event']['date']],
                    $row[$this->columns['event']['image']],
                    $row[$this->columns['event']['description']],
                    $row[$this->columns['event']['link']],
                    $row[$this->columns['event']['type']],
                    $row[$this->columns['event']['isMajor']],
                    $row[$this->columns['event']['price']]
                    );
        }
        
        $this->closeConnection($query);
        
        return $result;
    }

    // Protect at little bit from sql injection
    private function format($input)
    {
        $input = stripslashes($input);
        $input = mysql_real_escape_string($input);
        return $input;
    }
    
    public function checkCredentials($email, $password) {
        $this->openConnection();

        $email = $this->format($email);
        $password = $this->format($password);
        
        // Hier query auslagern in $this->queries["select"]
        $query = mysql_query("SELECT * FROM user WHERE email='$email' and password='$password'");

        $result = mysql_num_rows($query);
        if ($result)
        {
            $row = mysql_fetch_assoc($query);
            $this->isAdmin = $row[$this->columns['user']['isAdmin']];
        }
        
        $this->closeConnection($query);
        
        return $result;
    }
    
    public function isUserRegistered($email) {
        $this->openConnection();

        $email = $this->format($email);
        
        $query = mysql_query("SELECT * FROM user WHERE email='$email'");
        
        $result = mysql_num_rows($query);

        $this->closeConnection($query);
        
        if ($result > 0)
            return true;
        else
            return false;
    }
    
    public function isAdmin($email) {
        $this->openConnection();

        $email = $this->format($email);
        
        $query = mysql_query("SELECT * FROM user WHERE email='$email' AND is_admin=1");
        
        $result = mysql_num_rows($query);

        $this->closeConnection($query);
        
        if ($result > 0)
            return true;
        else
            return false;
    }
    
    public function Register($firstname, $lastname, $email, $password) {
        $this->openConnection();
        
        $firstname = $this->format($firstname);
        $lastname = $this->format($lastname);
        $email = $this->format($email);
        $password = $this->format($password);
        
        // Hier query auslagern in $this->queries["insert"]
        mysql_query("INSERT INTO user (firstname, lastname, password, email) VALUES ('".$firstname."','".$lastname."','".$password."','".$email."')");
        
        mysql_close();
    }
    
    public function CreateEvent($title, $date, $image, $description, $link, $type, $ismajor, $price) {
        $this->openConnection();
        
        $title = $this->format($title);
        $date = $this->format($date);
        $image = $this->format($image);
        $description = $this->format($description);
        $link = $this->format($link);
        $type = $this->format($type);
        $ismajor = $this->format($ismajor);
        $price = $this->format($price);
        
        // Hier query auslagern in $this->queries["insert"]
        mysql_query("INSERT INTO event (name, date, image, description, link, type, is_major, price) VALUES ('".$title."','".$date."','".$image."','".$description."','".$link."','".$type."','".$ismajor."','".$price."')");
        
        mysql_close();
    }
    
    public function UpdateEvent($id, $title, $date, $image, $description, $link, $type, $ismajor, $price) {
        $this->openConnection();
        
        $id = $this->format($id);
        $title = $this->format($title);
        $date = $this->format($date);
        $image = $this->format($image);
        $description = $this->format($description);
        $link = $this->format($link);
        $type = $this->format($type);
        $ismajor = $this->format($ismajor);
        $price = $this->format($price);
        
        // Hier query auslagern in $this->queries["insert"]
        //mysql_query("INSERT INTO event (name, date, image, description, link, type, is_major, price) VALUES ('".$title."','".$date."','".$image."','".$description."','".$link."','".$type."','".$ismajor."','".$price."')");
        
        mysql_close();
    }
    
    public function DeleteEvent($id) {
        $this->openConnection();
        
        $id = $this->format($id);
        
        mysql_query("DELETE FROM event WHERE id = ".$id);
        
        mysql_close();
    }
}

?>
