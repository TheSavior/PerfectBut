<?php
namespace Application\Modules\Setup\Controllers;

class Install extends \Saros\Application\Controller
{     
    public function indexAction() {
        $this->view->show(false);
               
        $this->registry->mapper->migrate('\Application\Entities\Users'); 
        $this->registry->mapper->migrate('\Application\Entities\Posts');
        
        $user = $this->registry->mapper->get('\Application\Entities\Users');
        $user->username = "Tester";
        $user->salt = \Application\Classes\Utils::generateSalt();
        $user->password = sha1($user->salt."tester");
        $this->registry->mapper->insert($user); 
        
        $posts = array();
        $posts[] = array("userId" => 1, "text", "text" => "Post number 1", "date_created" => time()-30, "upvote"=>4, "downvote" => 13);
        $posts[] = array("userId" => 1, "text", "text" => "Post number 2", "date_created" => time()-12, "upvote"=>6, "downvote" => 2);
        $posts[] = array("userId" => 1, "text", "text" => "Post number 3", "date_created" => time()-4, "upvote"=>2, "downvote" => 1);
        
        foreach($posts as $post) {
             $this->registry->mapper->insert('\Application\Entities\Posts', $post);
        }
    }
    
    public function resetAction() {
        $this->view->show(false);
        $this->registry->mapper->truncateDatasource('\Application\Entities\Users');
        $this->registry->mapper->truncateDatasource('\Application\Entities\Posts');
    }
}
