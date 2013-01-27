<?php
namespace Application\Modules\Main\Controllers;

class Index extends \Saros\Application\Controller
{
    public function init() {
        header('Access-Control-Allow-Origin: *');
    }
    
	public function indexAction()
	{
        $this->view->Posts = $GLOBALS["registry"]->mapper->all('\Application\Entities\Posts')->order(array("date_created"=>"desc"))->limit();
        
        
		$this->view->Version = \Saros\Version::getVersion();
	}
    
    public function logoutAction() {
        $this->view->show(false);
        
        $auth = \Saros\Auth::getInstance();
        $auth->clearIdentity();
        
        unset($_SESSION["username"]);
        unset($_SESSION["password"]);
        
        $this->redirect($GLOBALS["registry"]->utils->makeLink("Index", "index")); 
    }
}
