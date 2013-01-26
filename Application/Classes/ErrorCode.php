<?php
namespace Application\Classes;

class ErrorCode
{   
    public static function show($code) {
        $array = array(
            400 => "HTTP/1.1 400 Bad Request",
            401 => "HTTP/1.0 401 Unauthorized",
        );
        
        
        if (!in_array($code, $array)) {
            throw new \Exception("Invalid error code");
        }
        
        header($array[$code]);
            die();
    }
}