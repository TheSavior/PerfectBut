<?php
namespace Application\Modules\Api\Controllers;

class Users extends \Saros\Application\Controller
{
    public $mapper;

    public function init() {
        $this->mapper = $GLOBALS["registry"]->mapper;

        header("Content-Type: application/json", true);
    }

    /**
    * Call this function if the api method requires users to be signed in.
    * 
    */
    private function requireAuth() {
        $auth = \Saros\Auth::getInstance();

        if(!$auth->hasIdentity())
        {   
            \Application\Classes\ErrorCode::show(401);  
        }
    }      

    public function indexAction()
    {                
        \Application\Classes\ErrorCode::show(400);  
    }

    public function currentUserAction() {
        $this->view->show(false);
                           
        $auth = \Saros\Auth::getInstance();
        $this->requireAuth();
        echo json_encode($auth->getIdentity()->username);
    }
    
    public function loginAction() {
        if (!isset($_POST["username"]) || !isset($_POST["password"])) {
            \Application\Classes\ErrorCode::show(400);
        }
        
        $auth = \Saros\Auth::getInstance();
        $auth->getAdapter()->setCredential($_POST["username"], $_POST["password"]);
        $auth->authenticate();
        
        if (!$auth->hasIdentity())
        {
            \Application\Classes\ErrorCode::show(401);
        }
        else
        {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
        }
    }
}