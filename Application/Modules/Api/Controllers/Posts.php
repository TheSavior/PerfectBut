<?php
namespace Application\Modules\Api\Controllers;

class Posts extends \Saros\Application\Controller
{
    public $mapper;
    
    public function init() {
        $this->mapper = $GLOBALS["registry"]->mapper;
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
                                                    
    public function getAll() {
        $this->view->show(false);
        
        $items = array();
        $posts = $this->mapper->all('\Application\Entities\Posts')->order(array("date_created"=>"desc"))->limit();
        foreach($posts as $post) {
            $items[] = array("text"=> $post->text, "username" => $post->poster->username, "upvotes" => $post->upvote, "downvotes" => $post->downvote, "timestamp" => $post->date_created);
        }
        
        echo json_encode($items);
    }
    
    public function voteAction($postId, $vote) {
        $this->view->show(false);
        
        if (!in_array($vote, array("up", "down")))
            \Application\Classes\ErrorCode::show(400);
            
        $post = $this->mapper->get('\Application\Entities\Posts', $postId);
        if (!$post)
        {
              \Application\Classes\ErrorCode::show(400);
        }
        
        if ($vote == "up")
            $post->upvote++;
        else
            $post->downvote++;
            
        $this->mapper->update($post);
    }
}
