<?php 

namespace App\Middleware\Validation;


class ErrorMessage {


  public static $messages = [
    'required'  => ":field is required",
    'integer'   => ":field must be a number",
    'min'       => ":field must be at least :value characters!",
    'max'       => ":field must be less than :value characters!",
    'email'     => ":field Invalid email address!",
    'nullabel'  => ":field able to be empty but not less than 6 or at least 20 !",
    'notInt'  => ":field include numbers !"
  ];


}