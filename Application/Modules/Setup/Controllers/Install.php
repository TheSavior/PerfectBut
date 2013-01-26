<?php
namespace Application\Modules\Setup\Controllers;

class Install extends \Saros\Application\Controller
{     
    public function indexAction() {
        $this->view->show(false);
               
        $this->registry->mapper->migrate('\Application\Entities\Users');      
    }
    
    public function resetAction() {
        $this->view->show(false);
        $this->registry->mapper->truncateDatasource('\Application\Entities\Users');
    }
}
