<?php

/** User: LaMarca Creative... */

namespace app\core;

/**
 * Class Application
 * 
 * @author Keith Barreras <keith.barreras@gmail.com>
 * @package app\core
 */
class Application
{
    const EVENT_BEFORE_REQUEST = 'beforeRequest';
    const EVENT_AFTER_REQUEST = 'afterREquest';
    //protected array $eventListeners = [];

    //public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public  static Application $app;
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
}