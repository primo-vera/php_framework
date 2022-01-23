<?php
/**
 * User: LaMarca_Creative
 * Date: 1/21/2022
 * Time: 7:40 PM
 */

namespace app\core;
/**
 * Class Application
 * 
 * @author Keith Barreras <keith.barreras@gmail.com>
 * @package app\core
 */
class Application
{
    //const EVENT_BEFORE_REQUEST = 'beforeRequest';
    //const EVENT_AFTER_REQUEST = 'afterREquest';
    //protected array $eventListeners = [];

    public static $ROOT_DIR;
    public $router;
    public $request;
    public $response;
    public static $app;
    public $controller;
    public function __construct($rootPath) //This is saved as static property of the application//
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response); 
    }

    public function run() 
    {
       echo $this->router->resolve();
    }

    /**
     * @return \app\core\Controller
     */
    public function getController(): \app\core\Controller
    {
        return $this->controller;   
    }

    /**
     * @param \app\core\Controller $controller
     */
    public function setController(\app\core\Controller $controller): void
    {
        $this->controller = $controller;
    }
}