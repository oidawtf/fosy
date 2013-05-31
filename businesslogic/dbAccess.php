<?php

class dbAccess {
    
//  local DB    
    const host = "localhost";
    const db = "fosy";
    const user = "root";
    const password = "";
    
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
}

?>
