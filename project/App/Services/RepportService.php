<?php

namespace App\Services;

use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;
use App\Repositories\RepportRepository;

class RepportService
{

    private $repportRepository;
    private $session;

    public function __construct()
    {
        $this->repportRepository = new RepportRepository();
        $this->session = new Session();
    }

    public function getRepports()
    {
        $merchangisingRapports = $this->repportRepository->getMerchangisingRapports();
        $employeeRapports = $this->repportRepository->getEmployeeRapports();
        return ['merchandising' => $merchangisingRapports, 'employee' =>  $employeeRapports];
        // if ($result) {
        //     $this->session->setError('success', 'the Store Status will be ' . $result);
        //     http_response_code(200);
        //     echo json_encode(["success" => true, "message" => "Data saved successfully!"]);
        // } else {
        //     $this->session->setError('error', 'Error !!');
        // }
    }
}