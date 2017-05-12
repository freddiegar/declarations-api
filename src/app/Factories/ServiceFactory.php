<?php

namespace app\Factories;

use app\Constants\ServiceType;
use app\Models\RestService;
use app\Models\SoapService;

/**
 * Class ServiceFactory
 * @package app\Factories
 */
class ServiceFactory
{

    /**
     * ServiceFactory constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param $type
     * @return mixed
     */
    public static function instance($type)
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

        return new $factory();
    }
}
