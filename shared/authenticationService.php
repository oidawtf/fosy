<?php

class authenticationService {
    
    private $host;
    private $db;
    private $user;
    private $password;
    
    public function __construct($host, $user, $password, $db) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;
    }
    
    public static function format($input)
    {
        $input = stripslashes($input);
        $input = mysql_real_escape_string($input);
        return $input;
    }
    
    private function displayError($connection) {
        echo mysql_errno($connection) . ": " . mysql_error($connection). "\n";
    }
    
    private function openConnection()
    {
         $connection = mysql_connect($this->host, $this->user, $this->password) or die("cannot connect");
         mysql_query("SET NAMES 'utf8'");

         if (mysqli_connect_errno($connection))
         {
             printf("Connect failed: %s\n", mysqli_connect_error());
             exit();
         }
         
         mysql_select_db($this->db) or die("cannot connect");
         
         return $connection;
    }
    
    private function closeConnection($buffer) {
        mysql_free_result($buffer);
        mysql_close();  
    }
    
    public function checkCredentials($username, $password) {
        $this->openConnection();
        
        $username = authenticationService::format($username);
        $password = authenticationService::format($password);
        $password = md5($password);
        
        // Hier query auslagern in $this->queries["select"]
        $query = mysql_query("
            SELECT *
            FROM person
            WHERE username='$username' AND password='$password'
                ");

        $result = mysql_num_rows($query);
        $this->closeConnection($query);
        
        return $result;
    }
    
    public function isUserRegistered($username) {
        $this->openConnection();

        $username = authenticationService::format($username);
        
        $query = mysql_query("
            SELECT *
            FROM user
            WHERE email='$username'
                ");
        
        $result = mysql_num_rows($query);

        $this->closeConnection($query);
        
        if ($result > 0)
            return true;
        else
            return false;
    }
    
    public function selectUsers()
    {
        $this->openConnection();

        $query = mysql_query("
            SELECT
                P.id,
                P.firstname,
                P.lastname,
                P.username,
                R.roleId,
                R.rolename,
                R.content
            FROM person AS P
            LEFT OUTER JOIN (
                SELECT
                    PR.fk_person_id AS 'personId',
                    PR.fk_role_id AS 'roleId',
                    R.rolename,
                    R.content
                FROM person_role AS PR
                LEFT OUTER JOIN role AS R ON PR.fk_role_id = R.id
            ) AS R on R.personId = P.id
            WHERE username IS NOT NULL
            ");
        
        $result = array();
        while ($row = mysql_fetch_assoc($query)) {
            $person = array(
                'id' => $row['id'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'username' => $row['username'],
                'roles' => array(),
                'contents' => array()
            );
            $role = $row['rolename'];
            $contents = explode("|", $row['content']);
            
            if (!array_key_exists($person['id'], $result))
                $result[$person['id']] = $person;
            
            if (!array_key_exists($role, $result[$person['id']]['roles']))
                $result[$person['id']]['roles'][$role] = $role;
            
            foreach ($contents as $content)
                if (!array_key_exists($content, $result[$person['id']]['contents']))
                    $result[$person['id']]['contents'][$content] = $content;
        }
        
        $this->closeConnection($query);
        
        return $result;
    }
}

?>
