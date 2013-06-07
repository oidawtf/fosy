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
    
    private function displayError($connection) {
        echo mysql_errno($connection) . ": " . mysql_error($connection). "\n";
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

        $username = $this->format($username);
        
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
    
    public function selectCustomers($search)
    {
        $this->openConnection();

        $search = $this->format($search);
        
        if ($search == "")
            $where = "WHERE P.is_customer = 1";
        else
            $where = "WHERE 
                        (P.id like '%".$search."%' OR
                         P.username like '%".$search."%' OR
                         P.firstname like '%".$search."%' OR
                         P.lastname like '%".$search."%') AND P.is_customer = 1";
                
        $query = mysql_query("
            SELECT
                P.id,
                P.username,
                P.firstname,
                P.lastname,
                P.title,
                P.birthdate,
                P.street,
                P.housenumber,
                P.stiege,
                P.doornumber,
                P.city,
                P.zip,
                P.country,
                P.phone,
                P.fax,
                P.email,
                P.personnel_number,
                P.hiredate,
                P.position,
                P.is_distributor,
                P.is_customer,
                P.is_employee,
                COUNT(CR.id) AS 'count_requests'
            FROM person AS P left OUTER JOIN customer_request AS CR on P.id = CR.fk_person_id
            ".$where."
            GROUP BY P.id;
            ");
        
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
            $person->requests = $row['count_requests'];
            $result[] = $person;
        }
        
        $this->closeConnection($query);
        
        return $result;
    }

    public function selectRequestsByCustomer($customerId) {
        $customerId = $this->format($customerId);

        return $this->selectRequests("WHERE CR.fk_person_id = '".$customerId."'");
    }
    
    public function selectRequestsByUsername($username) {
        $username = $this->format($username);

        return $this->selectRequests("
                WHERE
                    CR.fk_responsible_user_id = (
                        SELECT id
                        FROM person
                        WHERE person.username = '".$username."'
                        )
                        ");
    }
    
    private function selectRequests($where)
    {
        $this->openConnection();
        
        $query = mysql_query("
            SELECT
                CR.id AS requestId,
                CR.text,
                CR.date,
                P.id AS customer_id,
                P.firstname AS customer_firstname,
                P.lastname AS customer_lastname,
                USER.id AS user_id,
                USER.username AS user_username,
                USER.firstname AS user_firstname,
                USER.lastname AS user_lastname,
                S.value AS status,
                CRT.type AS type,
                AM.name as manufacturer,
                A.model
            FROM
                customer_request AS CR
                LEFT OUTER JOIN person AS USER on CR.fk_responsible_user_id = USER.id
                LEFT OUTER JOIN person AS P on CR.fk_person_id = P.id
                LEFT OUTER JOIN status AS S on CR.fk_status_id = S.id
                LEFT OUTER JOIN customer_request_type AS CRT on CR.fk_customer_request_type_id = CRT.id
                LEFT OUTER JOIN article AS A on CR.fk_article_id = A.id
                LEFT OUTER JOIN article_manufacturer AS AM on A.fk_article_manufacturer_id = AM.id
            ".$where);
        
        $result = array();
        while ($row = mysql_fetch_assoc($query))
        {
            $request = new request();
            $request->id = $row['requestId'];
            $request->customerId = $row['customer_id'];
            $request->customer = $row['customer_firstname']." ".$row['customer_lastname'];
            $request->responsible_userId = $row['user_id'];
            $request->responsible_username = $row['user_username'];
            $request->responsible_user = $row['user_firstname']." ".$row['user_lastname'];
            $request->type = $row['type'];
            $request->article = $row['manufacturer']." ".$row['model'];
            $request->text = $row['text'];
            $request->status = $row['status'];
            $request->date = $row['date'];
            $result[] = $request;
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
                UPDATE person
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
                    email = '".$email."'
                WHERE id = '".$id."'
                ");
        
        mysql_close();
    }
    
    public function deactivateCustomer($id) {
        $this->openConnection();

        $id = $this->format($id);
        
        mysql_query("
            UPDATE person
            SET is_customer = '0'
            WHERE id = '".$id."'
            ");
        
        mysql_close();
    }
    
    public function insertRequest($customerId, $type_id, $article_id, $text, $status_id, $date) {
        $this->openConnection();
        
        $customerId = $this->format($customerId);
        $type_id = $this->format($type_id);
        $article_id = $this->format($article_id);
        $text = $this->format($text);
        $status_id = $this->format($status_id);
        $date = $this->format($date);
        
        mysql_query("
            INSERT INTO customer_request (fk_customer_request_type_id, fk_person_id, fk_article_id, fk_status_id, date, text)
            VALUES (
                '".$type_id."',
                '".$customerId."',
                '".$article_id."',
                '".$status_id."',
                '".$date."',
                '".$text."'
                    )
                ");
        
        mysql_close();
    }
    
    public function selectRequestTypes()
    {
        $this->openConnection();

        $query = mysql_query("SELECT * FROM customer_request_type");
        
        $result = array();
        while ($row = mysql_fetch_assoc($query))
            $result[] = array('id' => $row['id'], 'name' => $row['type']);
        
        $this->closeConnection($query);
        
        return $result;
    }
    
    public function selectArticleCategories()
    {
        $this->openConnection();

        $query = mysql_query("SELECT * FROM article_category");
        
        $result = array();
        while ($row = mysql_fetch_assoc($query))
            $result[] = array('id' => $row['id'], 'name' => $row['name']);
        
        $this->closeConnection($query);
        
        return $result;
    }
    
    public function selectArticles($article_category_id)
    {
        $this->openConnection();

        $query = mysql_query("
            SELECT
                A.id,
                A.model AS model,
                AM.name AS manufacturer
            FROM
                article AS A,
                article_manufacturer AS AM
            WHERE
                A.fk_article_category_id = '".$article_category_id."' AND
                A.fk_article_manufacturer_id = AM.id
                ");
        
        $result = array();
        while ($row = mysql_fetch_assoc($query))
            $result[] = array('id' => $row['id'], 'name' => $row['manufacturer']." ".$row['model']);
        
        $this->closeConnection($query);
        
        return $result;
    }
    
    public function selectStatus()
    {
        $this->openConnection();

        $query = mysql_query("SELECT * FROM status");
        
        $result = array();
        while ($row = mysql_fetch_assoc($query))
            $result[] = array('id' => $row['id'], 'name' => $row['value']);
        
        $this->closeConnection($query);
        
        return $result;
    }
}

?>
