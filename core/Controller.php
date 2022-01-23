<?php 
/**
 * User: LaMarca_Creative
 * Date: 1/21/2022
 * Time: 7:40 PM
 */

namespace app\core;

/**
* Class Controller
*
* @author Keith Barreras <keith.barreras@gmail.com>
* @package app\core
*/
class Controller
{
    public $layout = 'main';
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
}