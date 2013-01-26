<?php
namespace Application\Modules\Main\Controllers;

class Register extends \Saros\Application\Controller
{
    private $auth;

    private $session;

    public function init() {
        $this->registry->display->setLayout("Plain");
           
        $this->auth = \Saros\Auth::getInstance();

        if ($this->auth->hasIdentity()) {
            $this->redirect($GLOBALS["registry"]->utils->makeLink("Index", "index"));
        }

        $this->session = new \Saros\Session("Register"); 

        // If we are on any of these pages
        // and not signed in on facebook, make sure
        // we clear the data session object.
        if($this->auth->getLastCode() != \Application\Classes\Auth\Adapter\FbDb::YES_FB_NO_DB)
        {
            //$this->session->clear();
        }
    }

    public function indexAction()
    {

    }
    
    // this action shouldn't be needed. We need to clear the session
    // in the case that we get to the registration page, then sign out of facebook
    // and sign in as someone else.
    // TODO: we should check on every request if the fb id of the currently logged in
    // user matches that of the data array we have and clear the session if they don't
    public function clearAction() {
        $this->view->show(false);
        session_destroy();       
    }
    
    public function insertAction() {
        $this->view->show(false);
        
        $fbInfo = new \Application\Classes\FbInfo();
        $fbInfo->loadFbArray($GLOBALS["registry"]->facebook);
            
        $fbInfo->insert($GLOBALS["registry"]->mapper);
        
        $this->redirect($GLOBALS["registry"]->utils->makeLink("Index", "index"));
    }
    
    public function registerAction() {
        // You can only be on this page if you are logged in on facebook, but don't have an account
        if($this->auth->getLastCode() != \Application\Classes\Auth\Adapter\FbDb::YES_FB_NO_DB) {
            $this->redirect($GLOBALS["registry"]->utils->makeLink("Index", "index"));
        }
         die("booms");     
        // they are trying to register
        // TODO: Make this a form class
        if($_SERVER['REQUEST_METHOD'] == "POST") 
        {
            $username = \Application\Classes\Utils::sanitize($_POST["username"]);
            
            // Verify that nobody has that username
            $user = \Application\Classes\Utils::getUser($username);
            if ($user){
                die("A user is already using that username. Please go back and try again.");
            }
            
            $user = $fb->api("/me");
            die(var_dump($user));
            $user = $mapper->get('\Application\Entities\Users');
            
            $user->id = $user["id"];
            $user->username = $username;
            $mapper->insert($user);

            $this->redirect($GLOBALS["registry"]->utils->makeLink("Index", "index"));
        }
        else
        {
            $user = $GLOBALS["registry"]->facebook->api("/me");
            $this->view->UserName = $user["first_name"];
        }
    }
        
    // This is called after we have logged in with facebook.
    public function facebookCallbackAction() {
        $this->view->show(false);

        // check if we are registered, if we are
        // redirect to the main/index
        
        // if not, redirect to main/Register
        if($this->auth->hasIdentity())
        {
              //die("redir1");
            $this->redirect($GLOBALS["registry"]->utils->makeLink("Index", "index"));
        }
        else
        {
            //die("redir2");
            $this->redirect($GLOBALS["registry"]->utils->makeLink("Register", "register"));
        }
    }
}
