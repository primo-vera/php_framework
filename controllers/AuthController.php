<?php
/**
 * User: LaMarca_Creative
 * Date: 1/21/2022
 * Time: 7:40 PM
 */
namespace app\controllers;

use kb\phpmvc\Controller;
use kb\phpmvc\Request;
use app\models\User;
use kb\phpmvc\Application;
use kb\phpmvc\middlewares\AuthMiddleware;
use kb\phpmvc\Response;
use app\models\LoginForm;

/**
 * Class AuthController
 * 
 * @author Keith Barreras <keith.barreras@gmail.com>
 * @package app\controllers
 */
class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }
    public function login(Request $request, Response $response) 
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {
        $user = new User();
        if($request->isPost()) {
            
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                Application::$app->session->setflash('success', 'Your have successfully registered!');
                Application::$app->response->redirect('/');
                exit;
            }
            
            return $this->render('register', [
                'model' => $user
            ]);
        }
        $this->setLayout('auth');
            
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile()
    {
        return $this->render('profile');
    }

     public function admin()
    {
        return $this->render('admin');
    }
}