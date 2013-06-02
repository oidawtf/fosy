<?php

class controller {
    
    private static $content;
    private static $dataService;
    
    const sessionIDName = 'fosy_session';
    const sessionIDUser = "username";
    
    private static function getContent() {
        if (empty(controller::$content)) {
            controller::$content = array(
                'home' => new page('home', 'Home', 'ui/home.php'),
                'login' => new page('login', 'Login', 'ui/login.php'),
                'customerrequest' => new page('customerrequest', 'Anfrage erfassen', 'ui/customerrequest.php', array('home')),
                'maintaincustomer' => new page('maintaincustomer', 'Kunden ansehen', 'ui/maintaincustomer.php', array('home')),
                'customerdetails' => new page('customerdetails', 'Kunden bearbeiten', 'ui/customerdetails.php', array('home', 'maintaincustomer')),
                'createcustomer' => new page('createcustomer', 'Kunden hinzufügen', 'ui/customerdetails.php', array('home')),
                'createcampaign' => new page('createcampaign', 'Kampagne erstellen', 'ui/createcampaign.php', array('home')),
                'analysecampaign' => new page('analysecampaign', 'Kampagne analysieren', 'ui/analysecampaign.php', array('home'))
                );
        }

        return controller::$content;
    }
    
    private static function getDataService() {
        if (empty(controller::$dataService)) {
            controller::$dataService = new dbAccess();
        }
         
        return controller::$dataService;
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
        return controller::getDataService()->getCustomers($search);
    }
    
    public static function getCustomer($id) {
        foreach (controller::getCustomers("") as $customer)
            if ($customer->id == $id)
                return $customer;
    }
}

?>
