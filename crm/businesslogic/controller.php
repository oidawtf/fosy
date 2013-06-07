<?php

class controller {
    
    private static $content;
    private static $dataService;
    
    private static $requestTypes;
    private static $articleCategories;
    private static $status;
    
    const sessionIDName = 'fosy_session';
    const sessionIDUser = "username";
    
    private static function getContent() {
        if (empty(controller::$content)) {
            controller::$content = array(
                'home' => new page('home', 'Home', 'ui/home.php'),
                'login' => new page('login', 'Login', 'ui/login.php'),
                'showcustomers' => new page('showcustomers', 'Kunden ansehen', 'ui/showcustomers.php', false, array('home')),
                'customerdetails' => new page('customerdetails', 'Kundendetails', 'ui/customerdetails.php', true, array('home', 'showcustomers')),
                'editcustomer' => new page('editcustomer', 'Kunden bearbeiten', 'ui/editcustomer.php', true, array('home', 'showcustomers', 'customerdetails')),
                'requestdetails' => new page('requestdetails', 'Anfragendetails', 'ui/requestdetails.php', true, array('home', 'showcustomers', 'customerdetails')),
                'createrequest' => new page('createrequest', 'Anfrage erfassen', 'ui/editrequest.php', true, array('home', 'showcustomers', 'customerdetails')),
                'editrequest' => new page('editrequest', 'Anfrage bearbeiten', 'ui/editrequest.php', true, array('home', 'showcustomers', 'customerdetails', 'requestdetails')),
                'createcustomer' => new page('createcustomer', 'Kunden erfassen', 'ui/editcustomer.php', false, array('home')),
                'createcampaign' => new page('createcampaign', 'Kampagne erstellen', 'ui/createcampaign.php', true, array('home')),
                'analysecampaign' => new page('analysecampaign', 'Kampagne analysieren', 'ui/analysecampaign.php', true, array('home'))
                );
        }

        return controller::$content;
    }
    
    private static function getDataService() {
        if (empty(controller::$dataService))
            controller::$dataService = new dbAccess();
         
        return controller::$dataService;
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
    
    public static function getUsername() {
        @session_start();
        if (isset($_SESSION[self::sessionIDUser]))
            return $_SESSION[self::sessionIDUser];
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
    
    public static function getCustomers($search) {
        return controller::getDataService()->selectCustomers($search);
    }
    
    public static function getCustomer($id) {
        foreach (controller::getCustomers("") as $customer)
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
        $id = $_POST['id'];
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
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            controller::getDataService()->deactivateCustomer($id);   
        }
    }
    
    public static function createRequest($customerId) {
        if ($customerId == "")
            return;
        
        $type_id = $_POST['request_type'];
        $article_id = $_POST['article'];
        $text = $_POST['text'];
        $status_id = $_POST['status'];
        $date = date("Y-m-d");
        
        controller::getDataService()->insertRequest($customerId, $type_id, $article_id, $text, $status_id, $date);
    }
    
    public static function getArticles($article_category_id) {
        return controller::getDataService()->selectArticles($article_category_id);
    }
}

?>
