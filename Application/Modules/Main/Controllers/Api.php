<?php
namespace Application\Modules\Main\Controllers;

class Api extends \Saros\Application\Controller
{
    public function init() {
        $auth = \Saros\Auth::getInstance();
        
        if(!$auth->hasIdentity())
        {     
            header('HTTP/1.0 401 Unauthorized');
            die();
        }
    }        
    
    public function indexAction()
    {       
          header('HTTP/1.1 400 Bad Request');
          die();
    }
                                                    
    public function getPostsAction()
    {
        $this->view->show(false);
        
        $items = array();
        $posts = $GLOBALS["registry"]->mapper->all('\Application\Entities\Posts')->order(array("date_created"=>"desc"))->limit();
        foreach($posts as $post) {
            $items[] = array("text"=> $post->text, "username" => $post->poster->username, "upvotes" => $post->upvote, "downvotes" => $post->downvote, "timestamp" => $post->date_created);
        }
        
        echo json_encode($items);
    }
}
