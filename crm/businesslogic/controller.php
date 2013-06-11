<?php

require_once 'businesslogic/controllerBase.php';

class controller extends controllerBase {
    
    private static $content;
    
    private static $requestTypes;
    private static $articleCategories;
    private static $status;
    
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
    
    public static function getRequestTypes() {
        if (empty(controller::$requestTypes))
            controller::$requestTypes = controllerBase::getDataService()->selectRequestTypes();
        
        return controller::$requestTypes;
    }
    
    public static function getArticleCategories() {
        if (empty(controller::$articleCategories))
            controller::$articleCategories = controllerBase::getDataService()->selectArticleCategories();
        
        return controller::$articleCategories;
    }
    
    public static function getStatus() {
        if (empty(controller::$status))
            controller::$status = controllerBase::getDataService()->selectStatus();
        
        return controller::$status;
    }
    
    public static function getContentItem($key = "") {
        if ($key == "" && isset($_GET['content']))
                $key = $_GET['content'];
        
        if (!array_key_exists($key, controller::getContent()))
            if (authenticationController::isLoggedIn())
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
        
        return controllerBase::getDataService()->selectCustomersByCampaign($campaign->id, $campaign->medium, $namefilter, $zipfilter, $birthdatefilter);
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
        
        return controllerBase::getDataService()->selectArticlesByCampaign($campaign->id, $category_id, $manufacturer_id);
    }
    
    public static function getCustomers($search = NULL) {
        return controllerBase::getDataService()->selectCustomers($search);
    }
    
    public static function getCustomer($id) {
        foreach (controller::getCustomers() as $customer)
            if ($customer->id == $id)
                return $customer;
    }
    
    public static function getRequestById($id) {
        return controllerBase::getDataService()->selectRequestById($id);
    }
    
    public static function getRequestsByCustomer($customerId) {
        return controllerBase::getDataService()->selectRequestsByCustomer($customerId);
    }
    
    public static function getRequestsByUsername() {
        return controllerBase::getDataService()->selectRequestsByUsername(authenticationController::getUsername());
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
        
        controllerBase::getDataService()->updateRequest($id, $responsible_userId, $type_id, $article_id, $text, $status_id, $date);
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

        controllerBase::getDataService()->insertCustomer(
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

        controllerBase::getDataService()->updateCustomer(
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
            controllerBase::getDataService()->deactivateCustomer($id);   
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
        
        controllerBase::getDataService()->insertRequest($customerId, $responsible_userId, $type_id, $article_id, $text, $status_id, $date);
    }
    
    public static function getArticles($article_category_id) {
        return controllerBase::getDataService()->selectArticles($article_category_id);
    }
    
    public static function createCampaign() {
        controllerBase::getDataService()->deleteEmptyCampaigns();
        return controllerBase::getDataService()->insertCampaign();
    }
    
    public static function getCampaign($campaignId) {
        return controllerBase::getDataService()->selectCampaign($campaignId);
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
        
        controllerBase::getDataService()->updateCampaign($campaign);
        
        return $campaign;
    }
}

?>
