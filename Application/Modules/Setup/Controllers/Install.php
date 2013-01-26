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
        
        $texts = array(
            "he has a peg leg",
            "he thinks he's a pirate",
            "he has no eyebrows",
            "he is 3 inches shorter than you",
            "he has a higher voice than you",
            "he showers himself cologne",
            "he always talks in a baby voice",
            "he only whispers",
            "he has whatever hair style you have",
            "hes cross-eyed",
            "he wears body glitter and actually thinks it makes him look good",
            "he farts every time you make out",
            "his arms dont bend. He has stick arms",
            "he likes wearing high heels in private",
            "he is 2 years younger than you",
            "he looks like your mom",
            "he is 10 years older than you",
            "he is the same age as your dad",
        );
        
        foreach($texts as $text) {
            $post = array("userId" => 1, "text" => $text, "date_created" => time()-rand(0,60), "upvote"=>rand(0,3000), "downvote" => rand(0,1000));
            $this->registry->mapper->insert('\Application\Entities\Posts', $post);
        }
    }
    
    public function resetAction() {
        $this->view->show(false);
        $this->registry->mapper->truncateDatasource('\Application\Entities\Users');
        $this->registry->mapper->truncateDatasource('\Application\Entities\Posts');
    }
}
