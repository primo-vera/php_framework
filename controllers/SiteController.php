<?php
/**
 * User: LaMarca_Creative
 * Date: 1/21/2022
 * Time: 7:40 PM
 */
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;

/**
 * Class SiteController
 * 
 * @author Keith Barreras <keith.barreras@gmail.com>
 * @package app\controllers
 */
class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => "LaMarca_Creative"
        ];
        return $this->render('home', $params);
    }

    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thank you for contacting us!');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', ['model' => $contact]);
    }

}