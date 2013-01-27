<?php
namespace Application\Modules\Api\Controllers;

class Users extends \Saros\Application\Controller
{
    public $mapper;

    public function init() {
        $this->mapper = $GLOBALS["registry"]->mapper;

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

    public function currentUserAction() {
        $this->view->show(false);
                           
        $auth = \Saros\Auth::getInstance();
        $this->requireAuth();
        echo json_encode($auth->getIdentity()->username);
    }
    
    public function loginAction() {
        if (!isset($_POST["username"]) || !isset($_POST["password"])) {
            \Application\Classes\ErrorCode::show(400);
        }
        
        $auth = \Saros\Auth::getInstance();
        $auth->getAdapter()->setCredential($_POST["username"], $_POST["password"]);
        $auth->authenticate();
        
        if (!$auth->hasIdentity())
        {
            \Application\Classes\ErrorCode::show(401);
        }
        else
        {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
        }
    }
    
    public function registerAction() {
        if($_SERVER['REQUEST_METHOD'] == "POST") 
        {
            echo "Must be post";
            \Application\Classes\ErrorCode::show(400);
        }
        
        if (!isset($_POST["username"]) || !isset($_POST["password"])) {
            echo "Must pass username and password";
            \Application\Classes\ErrorCode::show(400);
        }
        
        if (preg_match('/^[a-z\d_]{5,20}$/i', $_POST["username"])) {
            echo "Invalid username. Must be between 5 and 20 characters and can only have numbers, letters, and underscores";
            \Application\Classes\ErrorCode::show(400);
        }

        // Verify that nobody has that username
        $user = \Application\Classes\Utils::getUser($_POST["username"]);
        if ($user){
            echo "A user is already using that username. Please go back and try again.";
            \Application\Classes\ErrorCode::show(400);
        }

        $user = $GLOBALS["registry"]->mapper->get('\Application\Entities\Users');
        
        $user->username = $_POST["username"];
        $user->salt = \Application\Classes\Utils::generateSalt();
        $user->password = sha1($user->salt.$_POST["password"]);
        $GLOBALS["registry"]->mapper->insert($user);
        
        $_SESSION["username"] = $user->username;
        $_SESSION["password"] = $user->password;
    }
}