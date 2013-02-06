<?php
namespace Application\Modules\Api\Controllers;

class Posts extends \Saros\Application\Controller
{
    public $mapper;

    public function init() {
        $this->mapper = $GLOBALS["registry"]->mapper;
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json", true);
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
                
        $items = array();
        $posts = $this->mapper->all('\Application\Entities\Posts')->order(array("date_created"=>"desc"))->limit();
        foreach($posts as $post) {
            $items[] = $this->postToArray($post);
        }

        echo json_encode($items);
    }
    
    private function postToArray(\Application\Entities\Posts $post) {
         return array("id" => $post->id, 
                            "text"=> $post->text, 
                            "username" => $post->poster->username, 
                            "upvotes" => $post->upvote, 
                            "downvotes" => $post->downvote, 
                            "timestamp" => $post->date_created,
                            "whenstring" => \Application\Classes\Utils::formatDate($post->date_created)
                            );
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

    public function postAction() {
        $this->view->show(false);

        //$this->requireAuth();

        if (!isset($_POST["text"])){
            echo "You must specify the post field 'text'";
            \Application\Classes\ErrorCode::show(400);
        }
        
        $postText = $_POST["text"];
          
        if (strlen($postText) < 10 || strlen($postText) > 160) {
            echo "Post is of an invalid length";
            \Application\Classes\ErrorCode::show(400);
        }
        
        //$location = $this->getCity();
              
        $post = $this->registry->mapper->get('\Application\Entities\Posts');
        
        $postText = preg_replace('/[^(\x20-\x7F)]*/','', $postText);
        $post->text = htmlspecialchars($postText);
        
        // It's a valid form for a post
        // Lets check it against recent posts
        $recentPosts = $GLOBALS["registry"]->mapper->all('\Application\Entities\Posts')->order(array("date_created"=>"desc"))->limit(30);
        foreach($recentPosts as $recentPost) {
            if (levenshtein($recentPost->text, $post->text) <= 4) {
                echo "Duplicate posts not allowed";
                \Application\Classes\ErrorCode::show(400);
            }
        }

        //$auth = \Saros\Auth::getInstance();
        //$post->userId = $auth->getIdentity()->getIdentifier();
        $post->date_created = time();
        $post->ip = \Application\Classes\Utils::getIp();
        
        /*if ($location)
        {
            $post->city = $location;
        }*/
        
        $this->registry->mapper->insert($post);
    }
    
    private function getCity() {           
        $ip = $_SERVER['REMOTE_ADDR'];

        $ip = filter_var($ip, FILTER_VALIDATE_IP);
        if (!$ip) 
            return false;
        
        $ctx=stream_context_create(array('http'=>
            array(
                'timeout' => 30 // 30 seconds
            )
        ));
        $url = 'http://api.ipinfodb.com/v3/ip-city/?key=d63d1b6152e01ac7848aa47e42c4b5e9077c5ede5f336a33ccbb07358d5ec46b&ip='.$ip;
        
        $content =  file_get_contents($url,false,$ctx);
        if (!$content) {
            return false;
        }
        $parts = explode(";", $content);
        
        return ucwords(strtolower($parts[6]));
    }
    
    public function allAfterAction($timestamp) {
        $this->view->show(false);
           
        $items = array();
        $posts = $this->mapper->all('\Application\Entities\Posts', array("date_created >" => $timestamp))->order(array("date_created"=>"desc"))->limit();
        foreach($posts as $post) {
            $items[] = $this->postToArray($post);
        }

        echo json_encode($items);
    }
    
    public function beforeAction($timestamp) {
        $this->view->show(false);
                                
        $items = array();
        $posts = $this->mapper->all('\Application\Entities\Posts', array("date_created <" => $timestamp))->order(array("date_created"=>"desc"))->limit();
        foreach($posts as $post) {
            $items[] = $this->postToArray($post);
        }

        echo json_encode($items);
    }
}