<?php 
/**
 * User: LaMarca_Creative
 * Date: 1/22/2022
 * Time: 9:48 PM
 */

namespace app\models;

use kb\phpmvc\DbModel;
use kb\phpmvc\Model;
use kb\phpmvc\UserModel;
use Dotenv\Parser\ParserInterface;

/**
  * Class User
  * 
  * @author Keith Barreras <keith.barreras@gmail.com>
  * @package app\models
  */
  class User extends UserModel
  {
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    

    public $firstname = '';
    public $lastname = '';
    public $email = '';
    public $status = self::STATUS_ACTIVE;
    public $is_admin = '';
    public $password = '';
    public $passwordConfirm = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public function primaryKey(): string
    {
        return 'id';
    }
  
    public function save()
    {   
        $this->status = self::STATUS_ACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();   
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 12]],
            'passwordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],

        ];
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password', 'status', 'is_admin'];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'passwordConfirm' => 'Confirm password',

        ];
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
  