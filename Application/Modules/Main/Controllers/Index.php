<?php
namespace Application\Modules\Main\Controllers;

class Index extends \Saros\Application\Controller
{
    public function init() {
    }
    
	public function indexAction()
	{
        $this->view->Posts = $GLOBALS["registry"]->mapper->all('\Application\Entities\Posts')->order(array("date_created"=>"desc"))->limit();
        
        
		$this->view->Version = \Saros\Version::getVersion();
	}
}
