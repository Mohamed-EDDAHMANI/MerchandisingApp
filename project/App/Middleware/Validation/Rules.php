<?php

namespace App\Middleware\Validation;


class Rules
{

  public static $rules = [
    'firstName' => 'required|min:3|max:20',
    'lastName' => 'required|min:4|max:20',
    'email'    => 'required|email',
    'password' => 'required|min:6',
    'store_id'  => 'required|integer',
  ];


}