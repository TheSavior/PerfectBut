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

    public function isLoggedInAction() {
        $this->view->show(false);
           
        $auth = \Saros\Auth::getInstance();
        echo json_encode($auth->hasIdentity());
    }
}