<?php

namespace App\Middleware\Validation;

use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;


class ValidationMiddleware
{

    private $validator;
    private $session;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->session = new Session();
    }


    public function userValidation($request)
    {
        $result = $this->validator->validate($request);
        if ($result) {
            $errorMessage = reset($result);
            $this->session->set('error', $errorMessage);
            Redirect::back();
            return ;
        }
        return ;
    }
}