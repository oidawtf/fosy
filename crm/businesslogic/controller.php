<?php

class controller {
    
    private static $content;
    
    private static $mediums;
    private static $requestTypes;
    private static $articleCategories;
    private static $status;
    
    private static $crmService;
    
    private static function getService() {
        if (empty(controller::$crmService))
            controller::$crmService = new crmService(
                    authenticationController::host,
                    authenticationController::user,
                    authenticationController::password,
                    authenticationController::db
                    );
         
        return controller::$crmService;
    }
    
    private static function getContent() {
        if (empty(controller::$content)) {
            controller::$content = array(
                'home' => new page('home', 'Home', 'ui/home.php'),
                'login' => new page('login', 'Login', 'ui/login.php'),
                'showcustomers' => new page('showcustomers', 'Kunden ansehen', 'ui/showcustomers.php', NULL, array('home')),
                'customerdetails' => new page('customerdetails', 'Kundendetails', 'ui/customerdetails.php', 'customerId', array('home', 'showcustomers')),
                'editcustomer' => new page('editcustomer', 'Kunden bearbeiten', 'ui/editcustomer.php', 'customerId', array('home', 'showcustomers', 'customerdetails')),
                'requestdetails' => new page('requestdetails', 'Anfragendetails', 'ui/requestdetails.php', 'requestId', array('home', 'showcustomers', 'customerdetails')),
                'createrequest' => new page('createrequest', 'Anfrage erfassen', 'ui/editrequest.php', 'customerId', array('home', 'showcustomers', 'customerdetails')),
                'editrequest' => new page('editrequest', 'Anfrage bearbeiten', 'ui/editrequest.php', 'requestId', array('home', 'showcustomers', 'customerdetails', 'requestdetails')),
                'createcustomer' => new page('createcustomer', 'Kunden erfassen', 'ui/editcustomer.php', NULL, array('home')),
                'showcampaigns' => new page('showcampaigns', 'Kampagnen anzeigen', 'ui/showcampaigns.php', NULL, array('home')),
                'editcampaign' => new page('editcampaign', 'Kampagne erstellen', 'ui/editcampaign.php', 'campaignId', array('home')),
                'addcustomerstocampaign' => new page('addcustomerstocampaign', 'Kunden hinzufügen', 'ui/addcustomerstocampaign.php', 'campaignId', array('home', 'editcampaign')),
                'customerdetailsfromcampaign' => new page('customerdetailsfromcampaign', 'Kundendetails', 'ui/customerdetails.php', 'customerId', array('home', 'editcampaign', 'addcustomerstocampaign')),
                'addarticlestocampaign' => new page('addarticlestocampaign', 'Artikel hinzufügen', 'ui/addarticlestocampaign.php', 'campaignId', array('home', 'editcampaign', 'addcustomerstocampaign')),
                'finalizecampaign' => new page('finalizecampaign', 'Kampagne fertigstellen', 'ui/finalizecampaign.php', 'campaignId', array('home', 'editcampaign', 'addcustomerstocampaign', 'addarticlestocampaign'))
                );
        }

        return controller::$content;
    }
    
    public static function getRequestTypes() {
        if (empty(controller::$requestTypes))
            controller::$requestTypes = controller::getService()->selectRequestTypes();
        
        return controller::$requestTypes;
    }
    
    public static function getArticleCategories() {
        if (empty(controller::$articleCategories))
            controller::$articleCategories = controller::getService()->selectArticleCategories();
        
        return controller::$articleCategories;
    }
    
    public static function getMediums() {
        if (empty(controller::$mediums)) {
            controller::$mediums = array(
                array('id' => 'email', 'name' => 'Newsletter'),
                array('id' => 'address', 'name' => 'Serienbrief')
            );
        }
        
        return controller::$mediums;
    }
    
    public static function getStatus() {
        if (empty(controller::$status))
            controller::$status = controller::getService()->selectStatus();
        
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
        
        return controller::getService()->selectCustomersByCampaign($campaign->id, $campaign->medium, $namefilter, $zipfilter, $birthdatefilter);
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
        
        return controller::getService()->selectArticlesByCampaign($campaign->id, $category_id, $manufacturer_id);
    }
    
    public static function getCustomers($search = NULL) {
        return controller::getService()->selectCustomers($search);
    }
    
    public static function getCustomer($id) {
        foreach (controller::getCustomers() as $customer)
            if ($customer->id == $id)
                return $customer;
    }
    
    public static function getRequestById($id) {
        return controller::getService()->selectRequestById($id);
    }
    
    public static function getRequestsByCustomer($customerId) {
        return controller::getService()->selectRequestsByCustomer($customerId);
    }
    
    public static function getRequestsByUsername() {
        return controller::getService()->selectRequestsByUsername(authenticationController::getUsername());
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
        
        controller::getService()->updateRequest($id, $responsible_userId, $type_id, $article_id, $text, $status_id, $date);
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

        controller::getService()->insertCustomer(
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

        controller::getService()->updateCustomer(
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
            controller::getService()->deactivateCustomer($id);   
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
        
        controller::getService()->insertRequest($customerId, $responsible_userId, $type_id, $article_id, $text, $status_id, $date);
    }
    
    public static function getArticles($article_category_id) {
        return controller::getService()->selectArticles($article_category_id);
    }
    
    public static function getCampaigns() {
        controller::getService()->deleteEmptyCampaigns();
        return controller::getService()->selectCampaigns();
    }
    
    public static function createCampaign() {
        controller::getService()->deleteEmptyCampaigns();
        $campaignId = controller::getService()->insertCampaign();
        $campaign = new campaign();
        $campaign->id = $campaignId;
        return $campaign;
    }
    
    public static function getCampaign($campaignId) {
        return controller::getService()->selectCampaign($campaignId);
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
        
        controller::getService()->updateCampaign($campaign);
        
        return $campaign;
    }
    
    public static function updateCampaignRelations() {
        if (
                !isset($_POST['type']) ||
                !isset($_POST['campaignId']) ||
                !isset($_POST['id']) ||
                !isset($_POST['checked']))
            return;
        
        $type = $_POST['type'];
        $campaignId = $_POST['campaignId'];
        $id = $_POST['id'];
        $checked = $_POST['checked'];
        
        switch ($type) {
            case 'customer':
                if ($checked == 'true')
                    controller::getService ()->insertCustomerIntoCampaign($campaignId, $id);
                else
                    controller::getService ()->deleteCustomerFromCampaign($campaignId, $id);
                break;
            case 'article':
                if ($checked == 'true')
                    controller::getService ()->insertArticleIntoCampaign($campaignId, $id);
                else
                    controller::getService ()->deleteArticleFromCampaign($campaignId, $id);
                break;
            default:
                return FALSE;
                break;
        }
    }
    
    public static function updateRealPrice() {
        if (
                !isset($_POST['campaignId']) ||
                !isset($_POST['articleId']) ||
                !isset($_POST['realprice']))
            return;

        $campaignId = $_POST['campaignId'];
        $articleId = $_POST['articleId'];
        $realprice = $_POST['realprice'];
        
        controller::getService()->updateRealPrice($campaignId, $articleId, $realprice);
    }
    
    public static function getLoginMessage() {
        if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password']))
            if (authenticationController::isLoginValid($_POST['username'], $_POST['password']))
                echo "<h4 class='alert_success'>Login erfolgreich!</h4>";
            else
                echo "<h4 class='alert_error'>Login fehlgeschlagen!</h4>";
    }
    
    public static function getSelectedCustomers($campaignId) {
        return controller::getService()->selectSelectedCustomers($campaignId);
    }
    
    public static function getSelectedArticles($campaignId) {
        return controller::getService()->selectSelectedArticles($campaignId);
    }
    
    public static function getCampaignData($campaignId) {
        $campaign = controller::getService()->selectCampaign($campaignId);
        
        $campaign->customers = controller::getService()->selectCampaignCustomersData($campaign);
        $campaign->articles = controller::getService()->selectCampaignArticlesData($campaign);
        
        return $campaign;
    }
    
    public static function isAuthorized($content) {
        if ($content == 'CONTENT')
            return "";
        
        if (authenticationController::isAuthorized($content))
            return "";
        
        return "disabled";
    }
}

?>
