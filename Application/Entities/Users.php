<?php
namespace Application\Entities;

class Users extends \Spot\Entity
{
	protected static $_datasource = 'users';

    public static function fields()
    {
        return array(
            'id' => array('type' => 'int', 'primary' => true, 'serial' => true),
            'username' => array('type' => 'string'),
            'password' => array('type' => 'string'),
            'salt' => array('type' => 'string')   
        );
    }
    
    public static function relations()
    {
        return array(
            // Each post entity 'hasMany' comment entites
            'posts' => array(
                'type' => 'HasMany',
                'entity' => '\Application\Entities\Posts',
                'where' => array('userId' => ':entity.id'),
                'order' => array('date_created' => 'ASC')
            )
        );
    }
}
