<?php
namespace Application\Entities;

class Users extends \Spot\Entity
{
	protected static $_datasource = 'users';

    public static function fields()
    {
        return array(
            'id' => array('type' => 'string', 'primary' => true),
            'username' => array('type' => 'string'),   
        );
    }
    
    public static function relations()
    {
        return array(
        );
    }
}
