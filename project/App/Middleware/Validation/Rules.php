<?php

namespace App\Middleware\Validation;


class Rules
{

  public static $rules = [
    'firstName' => 'required|min:3|max:20|notInt',
    'lastName' => 'required|min:4|max:20|notInt',
    'email'    => 'required|email',
    'password' => 'required|min:6|max:20',
    'store_id'  => 'required|integer',
    'passwordUpdate'  => 'nullabel',
    //store Rules
    'name' => 'required|min:3|max:20',
    'address' => 'required|min:6|max:30',
    'city' => 'required|min:3|max:20|notInt',
    'status' => 'required',
    'parking_space' => 'required',
    //categories
    'category_name' => 'required|min:2|max:20|notInt',
    'description' => 'required|min:2|notInt'
  ];


}