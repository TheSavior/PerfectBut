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
                                                    
    public function getAllAction() {
        $this->view->show(false);
        header("Content-Type: application/json", true);
        
        
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
    
    public function postAction($postText) {
        $this->view->show(false);
        
        $this->requireAuth();
        
        if (strlen($postText) < 10 || strlen($postText) > 160) {
            echo "Post is of an invalid length";
            \Application\Classes\ErrorCode::show(400);
        }
        
        $post = $this->registry->mapper->get('\Application\Entities\Posts');
        $post->text = htmlspecialchars($postText);
        
        $auth = \Saros\Auth::getInstance();
        $post->userId = $auth->getIdentity()->getIdentifier();
        $post->date_created = time();
        $this->registry->mapper->insert($post);
    }
}
