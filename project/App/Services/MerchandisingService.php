<?php

namespace App\Services;

use App\Repositories\MerchandisingRepository;
use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;

class MerchandisingService
{

    private $merchandisingRepository;
    private $session;

    public function __construct()
    {
        $this->merchandisingRepository = new MerchandisingRepository();
        $this->session = new Session();
    }

    public function analysePotentiel($data)
    {
        $result = $this->merchandisingRepository->analysePotentiel($data);
        if ($result) {
            $this->session->setError('success', 'the Store Status will be ' . $result);
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Data saved successfully!"]);
        } else {
            $this->session->setError('error', 'Error !!');
        }
    }
}