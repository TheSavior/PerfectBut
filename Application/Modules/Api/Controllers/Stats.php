<?php
namespace Application\Modules\Api\Controllers;

class Stats extends \Saros\Application\Controller
{
    public function init() {
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json", true);
    }
    
    public function indexAction()
    {
        $this->view->show(false); ;
        echo $GLOBALS["registry"]->mapper->all('\Application\Entities\Posts')->count();
    }
}
