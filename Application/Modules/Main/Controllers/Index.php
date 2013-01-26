<?php
namespace Application\Modules\Main\Controllers;

class Index extends \Saros\Application\Controller
{
    public function init() {
        $auth = \Saros\Auth::getInstance();
        
        if(!$auth->hasIdentity())
        {      
            // If we also don't have an identitiy, then we are not logged in at all
            $this->redirect($GLOBALS["registry"]->utils->makeLink("Register", "index"));
        }
    }
    
	public function indexAction()
	{
		$this->view->Version = \Saros\Version::getVersion();
	}
}
