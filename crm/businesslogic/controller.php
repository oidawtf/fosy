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
                'customerrequest' => array('title' => 'Kundenanfrage verwalten', 'file' => 'ui/customerrequest.php'),
                'maintaincustomer' => array('title' => 'Kunden verwalten', 'file' => 'ui/maintaincustomer.php')
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
    
    public static function getContentTitle() {
        $content = controller::getCurrentContent();
        return $content['title'];
    }
    
    public static function getContentPage() {
        $content = controller::getCurrentContent();
        return $content['file'];
    }
    
    private static function getCurrentContent() {
        if (isset($_GET['content']) && array_key_exists($_GET['content'], controller::getContent()))
            $key = $_GET['content'];
        elseif (controller::isLoggedIn())
            $key = 'home';
        else
            $key = 'login';
        
        $content = controller::getContent();
        return $content[$key];
    }
}

?>
