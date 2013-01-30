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
    
    public function getPostsAction($limit = 0, $offset = null) {
        $this->view->show(false);
        
        if ($limit != 0)
            $limit = intval($limit);
            
        if ($offset != null)
            $offset = intval($offset);
            
        header("Content-Type: text/plain", true);
                
        $items = array();
        $posts = $GLOBALS["registry"]->mapper->all('\Application\Entities\Posts')->order(array("date_created"=>"desc"))->limit($limit, $offset);
        foreach($posts as $post) {
            echo $post->text."\n";
        }
    }
}
