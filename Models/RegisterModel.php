<?php 
/**
 * User: LaMarca_Creative
 * Date: 1/22/2022
 * Time: 9:48 PM
 */

 namespace app\models;

use app\core\Model;

/**
  * Class RegisterModel
  * 
  * @author Keith Barreras <keith.barreras@gmail.com>
  * @package app\models
  */
  class RegisterModel extends Model
  {
      public $firstname = '';
      public $lastname = '';
      public $email = '';
      public $password = '';
      public $passwordConfirm = '';
  
    public function register()
    {
        echo "Creating new user";
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 12]],
            'passwordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],

        ];
    }

    }
  