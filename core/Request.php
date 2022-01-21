<?php 
/** User: LaMarca Creative... */

namespace app\core;

/**
* Class Request
*
* @author Keith Barreras <keith.barreras@gmail.com>
* @package app\core
*/
class Request {
    public function getPath() 
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $postion = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function getMethod() 
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}