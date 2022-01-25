<?php
/**
 * User: LaMarca_Creative
 * Date: 1/22/2022
 * Time: 11:47 PM
 */

namespace app\core\form;

use app\core\Model;

/**
 * Class Field
 * 
 * @author Keith Barreras <keith.barreras@gmail.com>
 * @package app\core\form
 */

 class Field 
 {
     public const TYPE_TEXT = 'text';
     public const TYPE_PASSWORD = 'password';
     public const TYPE_NUMBER = 'number';

     public $type;
     public $model;
     public $attribute;

     /**
      * Field constructor.
      *
      * @param \app\core\Model $model
      * @param string          $attribute
      */
      public function __construct(\app\core\Model $model, string $attribute)
      {
          $this->type = self::TYPE_TEXT;
          $this->model = $model;
          $this->attribute = $attribute;
      }

      public function __toString()
      {
        return sprintf('
            <div class="form-group">
                    <label>%s</label>
                    <input type="%s" name="%s" value="%s" class="form-control%s">
                    <div class="invalid-feedback">
                        %s
                    </div>
            </div>
        ', 
            $this->model->getLabel($this->attribute),
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->getFirstError($this->attribute),
        );
      }

        public function passwordField()
        {
            $this->type = self::TYPE_PASSWORD;
            return $this;
        }
      
 }