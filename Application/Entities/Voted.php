<?php
namespace Application\Entities;

class Voted extends \Spot\Entity
{
    protected static $_datasource = 'Voted';

    public static function fields()
    {
        return array(
            'id' => array('type' => 'int', 'primary' => true, 'serial' => true),
            'userId' => array('type' => 'int'),
            'postId' => array('type' => 'int')   
        );
    }
    
    public static function relations()
    {
        return array(
        );
    }
}
