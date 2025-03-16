<?php
namespace App\Controllers;

class BaseController {
    protected function view($view, $data = []) {
 
        extract($data);
     
        include dirname(__DIR__)."/../Views/$view.php";
    }

}