<?php 
/**
 * User: LaMarca_Creative
 * Date: 1/25/2022
 * Time: 7:19 PM
 */

namespace app\models;

use kb\phpmvc\Application;
use kb\phpmvc\Model;
use app\controllers\AuthController;

/**
  * Class LoginForm
  * 
  * @author Keith Barreras <keith.barreras@gmail.com>
  * @package app\models
  */
class LoginForm extends Model
{
    public $email = '';
    public $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Your email',
            'password' => 'Password'
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'User does not exist with this email');
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect!');
            return false;
        }
        
        return Application::$app->login($user);
    }
}