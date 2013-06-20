<?php

require_once 'authenticationService.php';

class authenticationController {
    
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
    
    private static $users;
    private static $service;
    
    const sessionIDName = 'fosy_session';
    const sessionIDUserId = "userId";
    const sessionIDUser = "username";
    const sessionIDUser_firstname = "user_firstname";
    const sessionIDUser_lastname = "user_lastname";
    const sessionIDUser_roles = "user_roles";
    const sessionIDUser_contents = "user_contents";
    
    private static function getService() {
        if (empty(authenticationController::$service))
            authenticationController::$service = new authenticationService(
                    authenticationController::host,
                    authenticationController::user,
                    authenticationController::password,
                    authenticationController::db
                    );
         
        return authenticationController::$service;
    }
    
    public static function getUsers() {
        if (empty(authenticationController::$users))
            authenticationController::$users = authenticationController::getService()->selectUsers();
        
        return authenticationController::$users;
    }
 
    public static function isLoginValid($username, $password) {
        return authenticationController::getService()->checkCredentials($username, $password);
    }
    
    public static function login($username) {
        @session_start();
        $_SESSION[self::sessionIDName] = 1;
        $_SESSION[self::sessionIDUser] = $username;
        
        foreach (authenticationController::getUsers() as $user)
            if ($user['username'] == $username) {
                $_SESSION[self::sessionIDUserId] = $user['id'];
                $_SESSION[self::sessionIDUser_firstname] = $user['firstname'];
                $_SESSION[self::sessionIDUser_lastname] = $user['lastname'];
                $_SESSION[self::sessionIDUser_roles] = $user['roles'];
                $_SESSION[self::sessionIDUser_contents] = $user['contents'];
                break;
            }
    }
    
    public static function logout() {
        @session_start();
        session_unset();
        $_SESSION = array();
        session_destroy();
    }
    
    public static function isLoggedIn() {
        @session_start();
        return isset($_SESSION[authenticationController::getSessionName()]);
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
                isset($_SESSION[self::sessionIDUser_lastname]) &&
                isset($_SESSION[self::sessionIDUser_roles]) &&
                isset($_SESSION[self::sessionIDUser_contents]))
            return array(
                "id" => $_SESSION[self::sessionIDUserId],
                "username" => $_SESSION[self::sessionIDUser],
                "firstname" => $_SESSION[self::sessionIDUser_firstname],
                "lastname" => $_SESSION[self::sessionIDUser_lastname],
                "roles" => $_SESSION[self::sessionIDUser_roles],
                "contents" => $_SESSION[self::sessionIDUser_contents]
                );
    }
    
    public static function getUsername() {
        $user = authenticationController::getUser();
        return $user['username'];
    }
    
    public static function getFullUsername() {
        return utils::ConvertUser(authenticationController::getUser());
    }
    
    private static function displayNoPermission() {
        echo
        "
            <h1>Forbidden</h1>
            <p>You don't have permission to access / on this server.</p>
        ";
        die();
    }
    
    public static function checkAuthentication() {
        if(!authenticationController::isLoggedIn())
            authenticationController::displayNoPermission();
    }
    
    public static function checkAuthorization($content = NULL) {
        if (isset($_GET['content']))
            $content = $_GET['content'];
        
        if (!authenticationController::isAuthorized($content))
            authenticationController::displayNoPermission();
    }
    
    public static function isAuthorized($content = NULL) {
        if ($content == NULL && isset($_GET['content']))
            $content = $_GET['content'];
        
        $user = authenticationController::getUser();
        return array_key_exists($content, $user['contents']);
    }
    
    public static function isRegistered($username) {
        return authenticationController::getService()->isUserRegistered($username);
    }
}

?>
