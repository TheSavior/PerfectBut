<?php
namespace Application\Classes\Auth\Adapter;

use \Saros\Auth;

/**
* This is the Auth adapter for Spot Compatible Databases
*
* @copyright Eli White & SaroSoftware 2010
* @license http://www.gnu.org/licenses/gpl.html GNU GPL
*
* @package SarosFramework
* @author Eli White
* @link http://sarosoftware.com
* @link http://github.com/TheSavior/Saros-Framework
*
*/
class FbDb implements \Saros\Auth\Adapter\IAdapter
{
    // Custom error code
    const YES_FB_NO_DB = -10;
    
    private $facebook;
    
    private $mapper;

    public function __construct(\Saros\Service\Facebook\Api $facebook, \Spot\Mapper $mapper)
    {
        $this->facebook = $facebook;
        $this->mapper = $mapper;
    }

    /**
    * Authenticate the request
    *
    * @return Saros_Auth_Result the result of the authentication
    *
    * @see Saros_Auth_Result
    */
    public function authenticate()
    {
        $user = $this->facebook->getUser();

        if($user)
        {
            try
            {
                // Proceed knowing you have a logged in user who's authenticated.
                $p = $this->facebook->api('/me');
                                          
                // Okay, we know that we have a user who is logged in on facebook.
                // Now we need to see if there is a user in our database who has the matching
                // ID.
                // TODO: Add a new identity type that is a db entity 
                $dbUser = $this->mapper->all("\\Application\\Entities\\Users", array(
                                                    "id" => $user
                                                    ))->execute();
                                                  
                if (count($dbUser) == 1)
                {
                    // If we have a user, return a Spot Identity of the user
                    //$userArray = $dbUser->toArray();
                    //var_dump($dbUser->first());
                    
                    $identity = new Auth\Identity\Spot($this->mapper, $dbUser->first());
                    return new Auth\Result(Auth\Result::SUCCESS, $identity);
                }
                else
                {
                    // otherwise, return the facebook identity
                    
                    $identity = new Auth\Identity\Facebook($p);
                    return new Auth\Result(self::YES_FB_NO_DB, $identity);
                }    
            } catch (\FacebookApiException $e) {
                error_log($e);
            }
        }
        
        return new Auth\Result(Auth\Result::FAILURE);
    }
}

