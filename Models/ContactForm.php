<?php 
/**
 * User: LaMarca_Creative
 * Date: 1/26/2022
 * Time: 6:10 PM
 */

namespace app\models;

use kb\phpmvc\Model;

/**
 * Class ContactForm
 * 
 * @author Keith Barreras <keith.barreras@gmail.com>
 * @package app\models
 */
class ContactForm extends Model
{
    public  $subject = "";
    public  $email = "";
    public  $body = "";

    public function rules(): array  
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Enter your subject',
            'email' => 'Your email',
            'body' => 'Body',
        ];
    }

    public function send()
    {
        return true;
    }
}