<?php

class controller {
    
    private static $content;
    private static $dataService;
    
    private static $users;
    private static $requestTypes;
    private static $articleCategories;
    private static $status;
    
    const sessionIDName = 'fosy_session';
    const sessionIDUserId = "userId";
    const sessionIDUser = "username";
    const sessionIDUser_firstname = "user_firstname";
    const sessionIDUser_lastname = "user_lastname";
    
    
    private static function getContent() {
        if (empty(controller::$content)) {
            controller::$content = array(
                'home' => new page('home', 'Home', 'ui/home.php'),
                'login' => new page('login', 'Login', 'ui/login.php'),
                'showcustomers' => new page('showcustomers', 'Kunden ansehen', 'ui/showcustomers.php', NULL, array('home')),
                'customerdetails' => new page('customerdetails', 'Kundendetails', 'ui/customerdetails.php', 'customerId', array('home', 'showcustomers')),
                'editcustomer' => new page('editcustomer', 'Kunden bearbeiten', 'ui/editcustomer.php', 'customerId', array('home', 'showcustomers', 'customerdetails')),
                'requestdetails' => new page('requestdetails', 'Anfragendetails', 'ui/requestdetails.php', 'customerId', array('home', 'showcustomers', 'customerdetails')),
                'createrequest' => new page('createrequest', 'Anfrage erfassen', 'ui/editrequest.php', 'customerId', array('home', 'showcustomers', 'customerdetails')),
                'editrequest' => new page('editrequest', 'Anfrage bearbeiten', 'ui/editrequest.php', 'customerId', array('home', 'showcustomers', 'customerdetails', 'requestdetails')),
                'createcustomer' => new page('createcustomer', 'Kunden erfassen', 'ui/editcustomer.php', NULL, array('home')),
                'editcampaign' => new page('editcampaign', 'Kampagne erstellen', 'ui/editcampaign.php', 'campaignId', array('home')),
                'addcustomerstocampaign' => new page('addcustomerstocampaign', 'Kunden hinzufügen', 'ui/addcustomerstocampaign.php', 'campaignId', array('home', 'editcampaign')),
                'customerdetailsfromcampaign' => new page('customerdetailsfromcampaign', 'Kundendetails', 'ui/customerdetails.php', 'customerId', array('home', 'editcampaign', 'addcustomerstocampaign')),
                'addarticlestocampaign' => new page('addarticlestocampaign', 'Artikel hinzufügen', 'ui/addarticlestocampaign.php', 'campaignId', array('home', 'editcampaign', 'addcustomerstocampaign')),
                'finalizecampaign' => new page('finalizecampaign', 'Kampagne fertigstellen', 'ui/finalizecampaign.php', 'campaignId', array('home', 'editcampaign', 'addcustomerstocampaign', 'addarticlestocampaign')),
                'analysecampaign' => new page('analysecampaign', 'Kampagne analysieren', 'ui/analysecampaign.php', 'campaignId', array('home'))
                );
        }

        return controller::$content;
    }
    
    private static function getDataService() {
        if (empty(controller::$dataService))
            controller::$dataService = new dbAccess();
         
        return controller::$dataService;
    }
    
    public static function getUsers() {
        if (empty(controller::$users))
            controller::$users = controller::getDataService()->selectUsers();
        
        return controller::$users;
    }
    
    public static function getRequestTypes() {
        if (empty(controller::$requestTypes))
            controller::$requestTypes = controller::getDataService()->selectRequestTypes();
        
        return controller::$requestTypes;
    }
    
    public static function getArticleCategories() {
        if (empty(controller::$articleCategories))
            controller::$articleCategories = controller::getDataService()->selectArticleCategories();
        
        return controller::$articleCategories;
    }
    
    public static function getStatus() {
        if (empty(controller::$status))
            controller::$status = controller::getDataService()->selectStatus();
        
        return controller::$status;
    }
    
    public static function isLoginValid($username, $password) {
        return controller::getDataService()->checkCredentials($username, $password);
    }
    
    public static function Login($username) {
        @session_start();
        $_SESSION[self::sessionIDName] = 1;
        $_SESSION[self::sessionIDUser] = $username;
        
        foreach (controller::getUsers() as $user)
            if ($user['username'] == $username) {
                $_SESSION[self::sessionIDUserId] = $user['id'];
                $_SESSION[self::sessionIDUser_firstname] = $user['firstname'];
                $_SESSION[self::sessionIDUser_lastname] = $user['lastname'];
                break;
            }
    }
    
    public static function Logout() {
        @session_start();
        session_unset();
        $_SESSION = array();
        session_destroy();
    }
    
    public static function isLoggedIn() {
        @session_start();
        return isset($_SESSION[controller::getSessionName()]);
    }
    
    public static function getSessionName() {
        return self::sessionIDName;
    }
    
    public static function getUser() {
        @session_start();
        if (
                isset($_SESSION[self::sessionIDUserId]) &&
                isset($_SESSION[self::sessionIDUser]) &&
                isset($_SESSION[self::sessionIDUser_firstname]) &&
                isset($_SESSION[self::sessionIDUser_lastname]))
            return array(
                "id" => $_SESSION[self::sessionIDUserId],
                "username" => $_SESSION[self::sessionIDUser],
                "firstname" => $_SESSION[self::sessionIDUser_firstname],
                "lastname" => $_SESSION[self::sessionIDUser_lastname]
                );
    }
    
    public static function getUsername() {
        $user = controller::getUser();
        return $user['username'];
    }
    
    public static function getFullUsername() {
        return utils::ConvertUser(controller::getUser());
    }
    
    public static function checkAuthentication() {
        if(!controller::isLoggedIn())
        {
            echo
            "
                <h1>Forbidden</h1>
                <p>You don't have permission to access / on this server.</p>
            ";
            die();
        }
    }
    
    public static function IsRegistered($username) {
        return controller::getDataService()->isUserRegistered($username);
    }
    
    public static function getContentItem($key = "") {
        if ($key == "" && isset($_GET['content']))
                $key = $_GET['content'];
        
        if (!array_key_exists($key, controller::getContent()))
            if (controller::isLoggedIn())
                $key = 'home';
            else
                $key = 'login';
        
        $content = controller::getContent();
        return $content[$key];
    }
    
    public static function getCustomersByCampaign($campaign) {
        if (isset($_GET['namefilter']))
            $namefilter = $_GET['namefilter'];
        else
            $namefilter = NULL;
        
        if (isset($_GET['zipfilter']))
            $zipfilter = $_GET['zipfilter'];
        else
            
            $zipfilter = NULL;
        if (isset($_GET['birthdatefilter']))
            $birthdatefilter = $_GET['birthdatefilter'];
        else
            $birthdatefilter = NULL;
        
        return controller::getDataService()->selectCustomersByCampaign($campaign->id, $campaign->medium, $namefilter, $zipfilter, $birthdatefilter);
    }
    
    public static function getArticlessByCampaign($campaign) {
        if (isset($_GET['category_id']))
            $category_id = $_GET['category_id'];
        else
            $category_id = NULL;
        
        if (isset($_GET['manufacturer_id']))
            $manufacturer_id = $_GET['manufacturer_id'];
        else
            $manufacturer_id = NULL;
        
        return controller::getDataService()->selectArticlesByCampaign($campaign->id, $category_id, $manufacturer_id);
    }
    
    public static function getCustomers($search = NULL) {
        return controller::getDataService()->selectCustomers($search);
    }
    
    public static function getCustomer($id) {
        foreach (controller::getCustomers() as $customer)
            if ($customer->id == $id)
                return $customer;
    }
    
    public static function getRequestById($id) {
        return controller::getDataService()->selectRequestById($id);
    }
    
    public static function getRequestsByCustomer($customerId) {
        return controller::getDataService()->selectRequestsByCustomer($customerId);
    }
    
    public static function getRequestsByUsername() {
        return controller::getDataService()->selectRequestsByUsername(controller::getUsername());
    }
    
    public static function editRequest($id) {
        if ($id == "")
            return;
        
        $type_id = $_POST['request_type'];
        $article_id = $_POST['article'];
        $responsible_userId = $_POST['responsible_userId'];
        $text = $_POST['text'];
        $status_id = $_POST['status'];
        $date = date("Y-m-d");
        
        controller::getDataService()->updateRequest($id, $responsible_userId, $type_id, $article_id, $text, $status_id, $date);
    }
    
    public static function createCustomer() {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $title = $_POST['title'];
        $birthdate = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $_POST['birthdate'])));
        $street = $_POST['street'];
        $housenumber = $_POST['housenumber'];
        $stiege = $_POST['stiege'];
        $doornumber = $_POST['doornumber'];
        $zip = $_POST['zip'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $phone = $_POST['phone'];
        $fax = $_POST['fax'];
        $email = $_POST['email'];

        controller::getDataService()->insertCustomer(
            $firstname,
            $lastname,
            $title,
            $birthdate,
            $street,
            $housenumber,
            $stiege,
            $doornumber,
            $zip,
            $city,
            $country,
            $phone,
            $fax,
            $email
            );
    }
    
    public static function editCustomer() {
        $id = $_POST['customerId'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $title = $_POST['title'];
        $birthdate = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $_POST['birthdate'])));
        $street = $_POST['street'];
        $housenumber = $_POST['housenumber'];
        $stiege = $_POST['stiege'];
        $doornumber = $_POST['doornumber'];
        $zip = $_POST['zip'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $phone = $_POST['phone'];
        $fax = $_POST['fax'];
        $email = $_POST['email'];

        controller::getDataService()->updateCustomer(
            $id,
            $firstname,
            $lastname,
            $title,
            $birthdate,
            $street,
            $housenumber,
            $stiege,
            $doornumber,
            $zip,
            $city,
            $country,
            $phone,
            $fax,
            $email
            );
    }

    public static function deleteCustomer() {
        if (isset($_POST['customerId'])) {
            $id = $_POST['customerId'];
            controller::getDataService()->deactivateCustomer($id);   
        }
    }
    
    public static function createRequest($customerId) {
        if ($customerId == "")
            return;
        
        $type_id = $_POST['request_type'];
        $article_id = $_POST['article'];
        $responsible_userId = $_POST['responsible_userId'];
        $text = $_POST['text'];
        $status_id = $_POST['status'];
        $date = date("Y-m-d");
        
        controller::getDataService()->insertRequest($customerId, $responsible_userId, $type_id, $article_id, $text, $status_id, $date);
    }
    
    public static function getArticles($article_category_id) {
        return controller::getDataService()->selectArticles($article_category_id);
    }
    
    public static function createCampaign() {
        controller::getDataService()->deleteEmptyCampaigns();
        return controller::getDataService()->insertCampaign();
    }
    
    public static function getCampaign($campaignId) {
        return controller::getDataService()->selectCampaign($campaignId);
    }
    
    public static function editCampaign($campaignId) {
        $campaign = new campaign();
        $campaign->id = $campaignId;
        $campaign->name = $_POST['name'];
        $campaign->description = $_POST['description'];
        $campaign->goal = $_POST['goal'];
        $campaign->date_from = $_POST['date_from'];
        $campaign->date_to = $_POST['date_to'];
        $campaign->budget = $_POST['budget'];
        $campaign->medium = $_POST['medium'];
        //$code = $_POST['code'];
        
        controller::getDataService()->updateCampaign($campaign);
        
        return $campaign;
    }
}

?>
