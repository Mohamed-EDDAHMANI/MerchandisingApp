<?php

namespace App\Middleware\Validation;


class Rules
{

  public static $rules = [
    'firstName' => 'required|min:3|max:20',
    'lastName' => 'required|min:4|max:20',
    'email'    => 'required|email',
    'password' => 'required|min:6|max:20',
    'store_id'  => 'required|integer',
    'passwordUpdate'  => 'nullabel',
    //store Rules
    'name' => 'required|min:3|max:20',
    'address' => 'required|min:6|max:30',
    'city' => 'required|min:4|max:20',
    'status' => 'required',
    'parking_space' => 'required',
  ];


}