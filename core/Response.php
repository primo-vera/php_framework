<?php 
/** User: LaMarca_Creative... */

namespace app\core;

/**
* Class Response
*
* @author Keith Barreras <keith.barreras@gmail.com>
* @package app\core
*/
class Response 
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}