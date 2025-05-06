<?php

namespace App\Controllers\Admin;

use App\Services\MerchandisingService;
use App\Utils\Redirects\Redirect;
use App\Controllers\BaseController;

class MerchandisingController
{
    private $merchandisingService;

    public function __construct() {
        $this->merchandisingService = new MerchandisingService();
    }

    public function analysePotentiel()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->merchandisingService->analysePotentiel($data);
    }
}

?>