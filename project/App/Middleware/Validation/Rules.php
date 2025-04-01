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
    'store_name' => 'required|min:3|max:20',
    'address' => 'required|min:6|max:30',
    'city' => 'required|min:3|max:20|notInt',
    'status' => 'required',
    'parking_space' => 'required',
    //categories
    'category_name' => 'required|min:2|max:20|notInt',
    'description' => 'required|min:2|notInt',
    //product
    'product_name' => 'required|min:2|max:100',
    'category_id' => 'required|integer',
    'trade_price' => 'required|integer|min:0',
    'sale_price' => 'required|integer|min:0',
    //supplier
    'supplier_name' => 'required|min:3|max:20|notInt',
    'contact_phone' => 'required|min:10|max:20|integer',
    'country' => 'required|min:3|max:20|notInt',
    'postal_code' => 'required|integer',
    //order
    'orderSupplier' => 'required|integer',
    'product_id' => 'required|integer',
    'orderQuantity' => 'required|integer|more:500',

  ];


}