<?php
namespace Application\Modules\Main\Controllers;

class Index extends \Saros\Application\Controller
{
    public function init() {
        $auth = \Saros\Auth::getInstance();
          
        // If we aren't signed in on facebook
        // redirect to the home page
        if($auth->getLastCode() == \Application\Classes\Auth\Adapter\FbDb::YES_FB_NO_DB)
        {
            // if we are signed in on facebook, but don't have an account
            // redirect to the registration page
            $this->redirect($GLOBALS["registry"]->utils->makeLink("Register", "register"));
        }
        elseif (!$auth->hasIdentity())
        {
            //die("toots");
            // If we also don't have an identitiy, then we are not logged in at all
            $this->redirect($GLOBALS["registry"]->utils->makeLink("Register", "index"));
        }
    }
    
	public function indexAction()
	{
		$this->view->Version = \Saros\Version::getVersion();
	}
    
    // This is called after we have logged in with facebook.
    public function facebookCallbackAction() {
        $this->view->show(false);
        
        // check if we are registered, if we are
        // redirect to the main/index
             die("whee");
        // if not, redirect to main/Register
        $auth = \Saros\Auth::getInstance();
        if($auth->hasIdentity())
        {
            $this->redirect($GLOBALS["registry"]->utils->makeLink("Index", "index"));
        }
        else
        {
            $this->redirect($GLOBALS["registry"]->utils->makeLink("Register", "index"));
        }
    }
}
