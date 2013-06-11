<?php

class crmService {
    
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
    
    public function selectCampaign($campaignId) {
        $this->openConnection();
        
        $campaignId = authenticationService::format($campaignId);

        $query = mysql_query("
            SELECT id, name, description, goal, date_from, date_to, budget, medium, code
            FROM campaign
            WHERE id = '".$campaignId."'
            ");
        
        $row = mysql_fetch_assoc($query);
        $campaign = new campaign();
        $campaign->id = $row['id'];
        $campaign->name = $row['name'];
        $campaign->description = $row['description'];
        $campaign->goal = $row['goal'];
        $campaign->date_from = $row['date_from'];
        $campaign->date_to = $row['date_to'];
        $campaign->budget = $row['budget'];
        $campaign->medium = $row['medium'];
        $campaign->code = $row['code'];
        
        $this->closeConnection($query);
        
        return $campaign;
    }
    
    public function selectCustomersByCampaign($campaignId, $medium, $namefilter, $zipfilter, $birthdatefilter) {
        if ($medium == "email")
            $where = "
                WHERE
                    P.email IS NOT NULL AND
                    P.email != '' AND
                    P.is_customer = 1
                    ";
        else
            $where = "WHERE P.is_customer = 1";
        
        $this->openConnection();
        
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
                CP.fk_campaign_id = '".$campaignId."' AS isSelected
            FROM
                person AS P
                LEFT OUTER JOIN campaign_person AS CP on P.id = CP.fk_person_id
            ".$where."
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
            $person->isSelected = $row['isSelected'];
            $result[] = $person;
        }
        
        $this->closeConnection($query);
        
        return $result;
    }
//    
//                SELECT
//                A.id AS article_id,
//SubCampaign.fk_campaign_id
//            FROM
//                article AS A
//                LEFT OUTER JOIN 
//                 (SELECT * from campaign_article  WHERE   campaign_article.fk_campaign_id = 2) AS SubCampaign  on A.id = SubCampaign.fk_article_id 
//
//    
    public function selectArticlesByCampaign($campaignId, $category_id, $manufacturer_id) {
        $this->openConnection();
        
        $where = "";
        
        $query = mysql_query("
            SELECT
                A.id AS article_id,
                AC.id AS category_id,
                AC.name AS category,
                AM.id AS manufacturer_id,
                AM.name AS manufacturer,
                A.model,
                A.description,
                A.picture,
                A.stock,
                A.purchase_price,
                A.selling_price,
                A.tax_rate,
                CA.real_price,
                CA.fk_campaign_id = '".$campaignId."' AS isSelected
            FROM
                article AS A
                LEFT OUTER JOIN campaign_article AS CA on A.id = CA.fk_article_id
                LEFT OUTER JOIN article_category AS AC on A.fk_article_category_id = AC.id
                LEFT OUTER JOIN article_manufacturer AS AM on A.fk_article_manufacturer_id = AM.id
            ".$where."
            ");
        
        $result = array();
        while ($row = mysql_fetch_assoc($query))
        {
            $article = new article();
            $article->id = $row['article_id'];
            $article->category_id = $row['category_id'];
            $article->category = $row['category'];
            $article->manufacturer_id = $row['manufacturer_id'];
            $article->manufacturer = $row['manufacturer'];
            $article->model = $row['model'];
            $article->description = $row['description'];
            $article->picture = $row['picture'];
            $article->stock = $row['stock'];
            $article->purchase_price = $row['purchase_price'];
            $article->selling_price = $row['selling_price'];
            if ($row['real_price'] == NULL)
                $article->real_price = $row['selling_price'];
            else
                $article->real_price = $row['real_price'];
            $article->tax_rate = $row['tax_rate'];
            $article->isSelected = $row['isSelected'];
            $result[] = $article;
        }
        
        $this->closeConnection($query);
        
        return $result;
    }
    
    public function selectCustomers($search = NULL) {
        $search = authenticationService::format($search);
        
        if ($search == NULL)
            $where = "WHERE P.is_customer = 1";
        else
            $where = "WHERE 
                        (P.id like '%".$search."%' OR
                         P.username like '%".$search."%' OR
                         P.firstname like '%".$search."%' OR
                         P.lastname like '%".$search."%') AND P.is_customer = 1";
        
        return $this->selectCustomersInternal($where);
    }
    
    public function selectCustomersInternal($where)
    {
        $this->openConnection();
        
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
            FROM
                person AS P
                LEFT OUTER JOIN customer_request AS CR on P.id = CR.fk_person_id
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
    
    public function selectRequestById($id) {
        $id = authenticationService::format($id);

        $requests = $this->selectRequests("WHERE CR.id = '".$id."'");
        if (count($requests) > 0)
            return $requests[0];
        
        return NULL;
    }

    public function selectRequestsByCustomer($customerId) {
        $customerId = authenticationService::format($customerId);

        return $this->selectRequests("WHERE CR.fk_person_id = '".$customerId."'");
    }
    
    public function selectRequestsByUsername($username) {
        $username = authenticationService::format($username);

        return $this->selectRequests("
                WHERE
                    CR.fk_responsible_user_id = (
                        SELECT id
                        FROM person
                        WHERE person.username = '".$username."' AND CR.fk_status_id != 3
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
                CRT.id AS typeId,
                CRT.type AS type,
                AM.id AS manufacturer_id,
                AM.name AS manufacturer,
                A.id AS article_id,
                A.model AS article_model,
                AC.id AS article_category_id,
                AC.name AS article_category
            FROM
                customer_request AS CR
                LEFT OUTER JOIN person AS USER on CR.fk_responsible_user_id = USER.id
                LEFT OUTER JOIN person AS P on CR.fk_person_id = P.id
                LEFT OUTER JOIN status AS S on CR.fk_status_id = S.id
                LEFT OUTER JOIN customer_request_type AS CRT on CR.fk_customer_request_type_id = CRT.id
                LEFT OUTER JOIN article AS A on CR.fk_article_id = A.id
                LEFT OUTER JOIN article_manufacturer AS AM on A.fk_article_manufacturer_id = AM.id
                LEFT OUTER JOIN article_category AS AC on A.fk_article_category_id = AC.id
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
            $request->typeId = $row['typeId'];
            $request->type = $row['type'];
            $request->article_id = $row['article_id'];
            $request->article_model = $row['article_model'];
            $request->article_category_id = $row['article_category_id'];
            $request->article_category = $row['article_category'];
            $request->manufacturer_id = $row['manufacturer_id'];
            $request->manufacturer = $row['manufacturer'];
            $request->text = $row['text'];
            $request->status = $row['status'];
            $request->date = $row['date'];
            $result[] = $request;
        }
        
        $this->closeConnection($query);
        
        return $result;
    }
    
    public function updateRequest($id, $responsible_userId, $type_id, $article_id, $text, $status_id, $date) {
        $this->openConnection();

        $id = authenticationService::format($id);
        $type_id = authenticationService::format($type_id);
        $article_id = authenticationService::format($article_id);
        $text = authenticationService::format($text);
        $status_id = authenticationService::format($status_id);
        $date = authenticationService::format($date);
        
        mysql_query("
                UPDATE customer_request
                SET
                    fk_customer_request_type_id = '".$type_id."',
                    fk_article_id = '".$article_id."',
                    fk_responsible_user_id = '".$responsible_userId."',
                    text = '".$text."',
                    fk_status_id = '".$status_id."',
                    date = '".$date."'
                WHERE id = '".$id."'
                ");
        
        mysql_close();
    }
    
    public function insertCustomer($firstname, $lastname, $title, $birthdate, $street, $housenumber, $stiege, $doornumber, $zip, $city, $country, $phone, $fax, $email) {
        $this->openConnection();

        $firstname = authenticationService::format($firstname);
        $lastname = authenticationService::format($lastname);
        $title = authenticationService::format($title);
        $birthdate = authenticationService::format($birthdate);
        $street = authenticationService::format($street);
        $housenumber = authenticationService::format($housenumber);
        $stiege = authenticationService::format($stiege);
        $doornumber = authenticationService::format($doornumber);
        $zip = authenticationService::format($zip);
        $city = authenticationService::format($city);
        $country = authenticationService::format($country);
        $phone = authenticationService::format($phone);
        $fax = authenticationService::format($fax);
        $email = authenticationService::format($email);

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

        $id = authenticationService::format($id);
        $firstname = authenticationService::format($firstname);
        $lastname = authenticationService::format($lastname);
        $title = authenticationService::format($title);
        $birthdate = authenticationService::format($birthdate);
        $street = authenticationService::format($street);
        $housenumber = authenticationService::format($housenumber);
        $stiege = authenticationService::format($stiege);
        $doornumber = authenticationService::format($doornumber);
        $zip = authenticationService::format($zip);
        $city = authenticationService::format($city);
        $country = authenticationService::format($country);
        $phone = authenticationService::format($phone);
        $fax = authenticationService::format($fax);
        $email = authenticationService::format($email);
        
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

        $id = authenticationService::format($id);
        
        mysql_query("
            UPDATE person
            SET is_customer = '0'
            WHERE id = '".$id."'
            ");
        
        mysql_close();
    }
    
    public function insertRequest($customerId, $responsible_userId, $type_id, $article_id, $text, $status_id, $date) {
        $this->openConnection();
        
        $customerId = authenticationService::format($customerId);
        $type_id = authenticationService::format($type_id);
        $article_id = authenticationService::format($article_id);
        $text = authenticationService::format($text);
        $status_id = authenticationService::format($status_id);
        $date = authenticationService::format($date);
        
        mysql_query("
            INSERT INTO customer_request (fk_customer_request_type_id, fk_responsible_user_id, fk_person_id, fk_article_id, fk_status_id, date, text)
            VALUES (
                '".$type_id."',
                '".$responsible_userId."',
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
    
    public function deleteEmptyCampaigns() {
        $this->openConnection();

        mysql_query("
            DELETE
            FROM campaign
            WHERE
                name IS NULL AND
                description IS NULL AND
                goal IS NULL AND
                date_from IS NULL AND
                date_to IS NULL AND
                budget IS NULL AND
                medium IS NULL AND
                code IS NULL
            ");
        
        mysql_close();
    }
    
    public function insertCampaign() {
        $this->openConnection();

        mysql_query("INSERT INTO campaign () VALUES ()");
        
        $campaignId = mysql_insert_id();
        
        mysql_close();
        
        return $campaignId;
    }
    
    public function updateCampaign($campaign) {
        $this->openConnection();

        $campaignId = authenticationService::format($campaign->id);
        $name = authenticationService::format($campaign->name);
        $description = authenticationService::format($campaign->description);
        $goal = authenticationService::format($campaign->goal);
        $date_from = authenticationService::format($campaign->date_from);
        $date_to = authenticationService::format($campaign->date_to);
        $budget = authenticationService::format($campaign->budget);
        $medium = authenticationService::format($campaign->medium);
        
        mysql_query("
                UPDATE campaign
                SET
                    name = '".$name."',
                    description = '".$description."',
                    goal = '".$goal."',
                    date_from = '".$date_from."',
                    date_to = '".$date_to."',
                    budget = '".$budget."',
                    medium = '".$medium."'
                WHERE id = '".$campaignId."'
                ");
        
        mysql_close();
    }
}

?>
