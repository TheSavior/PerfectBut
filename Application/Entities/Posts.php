<?php
namespace Application\Entities;

class Posts extends \Spot\Entity
{
    protected static $_datasource = 'posts';

    public static function fields()
    {
        return array(
            'id' => array('type' => 'int', 'primary' => true, 'serial' => true),
            'userId' => array('type' => 'int'),
            'text' => array('type' => 'string'),
            'date_created' => array('type' => 'int'),
            'upvote' => array('type' => 'int', 'default' => 0),
            'downvote' => array('type' => 'int', 'default' => 0)   
        );
    }
    
    public static function relations()
    {
        return array(
            // Each post entity 'hasMany' comment entites
            'poster' => array(
                'type' => 'HasOne',
                'entity' => '\Application\Entities\Users',
                'where' => array('id' => ':entity.userId')
            )
        );
    }
}
