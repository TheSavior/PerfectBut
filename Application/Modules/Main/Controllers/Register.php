<?php
namespace Application\Modules\Main\Controllers;

class Register extends \Saros\Application\Controller
{
    private $auth;

    private $session;

    public function init() {
        $this->registry->display->setLayout("Plain");
           
        $this->auth = \Saros\Auth::getInstance();

        if ($this->auth->hasIdentity()) {
            $this->redirect($GLOBALS["registry"]->utils->makeLink("Index", "index"));
        }
        
        $this->session = new \Saros\Session("User");
    }
    
    public function indexAction() {
        if($_SERVER['REQUEST_METHOD'] == "POST") 
        {
            $this->auth->getAdapter()->setCredential($_POST["username"], $_POST["password"]);
            $this->auth->authenticate();
            
            if (!$this->auth->hasIdentity())
            {
                die("Invalid login, please go back and try again");
            }
            else
            {
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["password"] = $_POST["password"];
                
                $this->redirect($GLOBALS["registry"]->utils->makeLink("Index", "index"));
            }
        }
    }
    
    public function registerAction() {
        if($_SERVER['REQUEST_METHOD'] == "POST") 
        {
            if (preg_match('/^[a-z\d_]{5,20}$/i', $_POST["username"])) {
                die("Invalid username. Must be between 5 and 20 characters and can only have numbers, letters, and underscores");
            }

            // Verify that nobody has that username
            $user = \Application\Classes\Utils::getUser($_POST["username"]);
            if ($user){
                die("A user is already using that username. Please go back and try again.");
            }

            $user = $GLOBALS["registry"]->mapper->get('\Application\Entities\Users');
            
            $user->username = $_POST["username"];
            $user->salt = \Application\Classes\Utils::generateSalt();
            $user->password = sha1($user->salt.$_POST["password"]);
            $GLOBALS["registry"]->mapper->insert($user);
            
            $_SESSION["username"] = $user->username;
            $_SESSION["password"] = $user->password;
            
            $this->redirect($GLOBALS["registry"]->utils->makeLink("Index", "index"));
        }
    }
}
