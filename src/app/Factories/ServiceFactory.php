<?php

namespace app\Factories;

use app\Constants\ServiceType;
use app\Models\RestService;
use app\Models\SoapService;

class ServiceFactory
{

    /**
     * @param array $authentication
     * @param $type
     * @return mixed
     */
    public static function instance(array $authentication, $type)
    {
        switch ($type) {
            case ServiceType::REST:
                $factory = RestService::class;
                break;
            case ServiceType::SOAP:
            default:
                $factory = SoapService::class;
                break;
        }

        return new $factory($authentication);
    }
}
