<?php
/**
 * User: LaMarca_Creative
 * Date: 1/21/2022
 * Time: 7:40 PM
 */
namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\User;
use app\core\Application;

/**
 * Class AuthController
 * 
 * @author Keith Barreras <keith.barreras@gmail.com>
 * @package app\controllers
 */
class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
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
}