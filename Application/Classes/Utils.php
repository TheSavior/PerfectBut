<?php
namespace Application\Classes;

class Utils
{   
    /**
    * Get a user 
    * 
    * @param mixed $user If $user is a string, looks up a user based on username, if number, looks up by id
    * @return null if no user matches, or \Application\Entities\Users otherwise
    * @throws 
    */
    public static function getUser($user) {
        $mapper = $GLOBALS["registry"]->mapper;
        $entity = '\Application\Entities\Users';
        
        if (is_string($user)) {
            return $mapper->first($entity, array('username' => $user));
        }
    }
    
    public static function dotdotdot($string, $length)
    {
        if (strlen($string) > $length)
            $string = substr($string, 0, $length - 3)."...";
        
        return $string;
    }
    
    /**
    * Santize user input to be displayed back on the screen
    * 
    * @param string $string the string to sanitize
    */
    public static function sanitize($string) {
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlentities($string, ENT_NOQUOTES, "UTF-8");
         
        $string = nl2br($string);
        $string = str_replace("\t",str_repeat("&nbsp;",4), $string);
                
        return $string;
    }
    
    public static function generateSalt($max = 5) {
        $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
        $i = 0;
        $salt = "";
        while ($i < $max) {
            $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
            $i++;
        }
        return $salt;
    }
}