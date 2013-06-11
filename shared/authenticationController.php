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
    
    public static function Login($username) {
        @session_start();
        $_SESSION[self::sessionIDName] = 1;
        $_SESSION[self::sessionIDUser] = $username;
        
        foreach (authenticationController::getUsers() as $user)
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
                isset($_SESSION[self::sessionIDUser_lastname]))
            return array(
                "id" => $_SESSION[self::sessionIDUserId],
                "username" => $_SESSION[self::sessionIDUser],
                "firstname" => $_SESSION[self::sessionIDUser_firstname],
                "lastname" => $_SESSION[self::sessionIDUser_lastname]
                );
    }
    
    public static function getUsername() {
        $user = authenticationController::getUser();
        return $user['username'];
    }
    
    public static function getFullUsername() {
        return utils::ConvertUser(authenticationController::getUser());
    }
    
    public static function checkAuthentication() {
        if(!authenticationController::isLoggedIn())
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
        return authenticationController::getService()->isUserRegistered($username);
    }
}

?>
