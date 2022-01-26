<?php
/**
 * User: LaMarca_Creative
 * Date: 1/21/2022
 * Time: 7:40 PM
 */

namespace app\core;

use app\core\Database;
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

    public $userClass;
    public $router;
    public $request;
    public $response;
    public $session;
    public $db;
    public $user;

    public static $app;
    public $controller;
    public function __construct($rootPath, array $config) //This is saved as static property of the application//
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        
        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
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

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }
    
    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}