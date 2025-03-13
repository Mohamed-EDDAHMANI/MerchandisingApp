<?php

namespace App\Middleware\Validation;


class Validator
{

  private $data;
  private $errors = [];


  public function __construct()
  {
    //   $this->data = $data;
    //   $this->validate();
  }


  public function validate($request)
  {
    foreach (Rules::$rules as $field => $rules) {
      foreach ($request as $key => $value) {
        if ($field == $key) {
          $this->applyRules($rules, $value, $field);
          if ($this->isErrors()) {
            return $this->getErrors();
          }
        }
      }
    }
  }



  public function applyRules($rules, $value, $field)
  {
    
    $rules = explode('|', $rules);

    foreach ($rules as $rule) {
      switch ($rule) {
        case 'integer':
          if (!is_numeric($value)) {
            $this->addError($field, $rule);
          }
          break;
        case 'required':
          if (empty($value)) {
            $this->addError($field, $rule);
          }
          break;
        case 'min:3':
          if (explode(':', $rule)[1] > strlen($value)) {
            $this->addError($field, explode(':', $rule)[0], explode(':', $rule)[1]);
          }
          break;
        case 'min:4':
          if (explode(':', $rule)[1] > strlen($value)) {
            $this->addError($field, explode(':', $rule)[0], explode(':', $rule)[1]);
          }
          break;
        case 'min:6':
          if (explode(':', $rule)[1] > strlen($value)) {
            $this->addError($field, explode(':', $rule)[0], explode(':', $rule)[1]);
          }
          break;
        case 'max:20':
          if (explode(':', $rule)[1] < strlen($value)) {
            $this->addError($field, explode(':', $rule)[0], explode(':', $rule)[1]);
          }
          break;

        case 'email':
          if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, $rule);
          }
          break;
        case 'nullabel':
          if (!empty($value)) {
            if(6 > strlen($value) || 20 < strlen($value)){
              $this->addError($field, $rule);
            }
          }
          break;
      }
    }
  }




  // add errors : 
  private function addError($field, $rule, $value = null)
  {
    $message = ErrorMessage::$messages[$rule];
    $message = str_replace(':field', $field, $message);

    if ($value) {
      $message = str_replace(':value', $value, $message);
    }

    $this->errors[$field]= $message;
  }




  public function getErrors()
  {
    return $this->errors;
  }


  public function isErrors()
  {
    return !empty($this->errors);
  }

}