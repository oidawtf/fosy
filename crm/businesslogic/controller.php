<?php

class controller {
    
    private static $content;
    private static $dataService;
    
    const sessionIDName = 'fosy_session';
    const sessionIDUser = "username";
    
    private static function getContent() {
        if (empty(controller::$content)) {
            controller::$content = array(
                'home' => array('title' => 'Home', 'file' => 'ui/home.php'),
                'login' => array('title' => 'Login', 'file' => 'ui/login.php'),
                'customerrequest' => array('title' => 'Anfrage erfassen', 'file' => 'ui/customerrequest.php'),
                'maintaincustomer' => array('title' => 'Kunden ansehen', 'file' => 'ui/maintaincustomer.php'),
                'customerdetails' => array('title' => 'Kunden bearbeiten', 'file' => 'ui/customerdetails.php'),
                'createcustomer' => array('title' => 'Kunden hinzufügen', 'file' => 'ui/customerdetails.php'),
                'createcampaign' => array('title' => 'Kampagne erstellen', 'file' => 'ui/createcampaign.php'),
                'analysecampaign' => array('title' => 'Kampagne analysieren', 'file' => 'ui/analysecampaign.php')
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
    
    public static function getContentTitle($key = "") {
        $content = controller::getContentItem($key);
        return $content['title'];
    }
    
    public static function getContentPage($key = "") {
        $content = controller::getContentItem($key);
        return $content['file'];
    }
    
    private static function getContentItem($key) {
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
