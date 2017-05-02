<?php 

namespace app\Controllers;

use app\Models\Company;
use app\Models\CompanyEmail;
use app\Models\Bidder;
use app\Models\BidderEmail;
use app\Models\CompanyRegister;
use app\Models\ConsumerRent;
use app\Models\InformationRequest;
use app\Exceptions\MyException;

class Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        echo 'Hello world!';
    }

    public function company($options = [])
    {
        return (new Company($options))->call()->response();
    }

    public function companyEmail($options = [])
    {
        return (new CompanyEmail($options))->call()->response();
    }

    public function bidder($options = [])
    {
        return (new Bidder($options))->call()->response();
    }

    public function bidderEmail($options = [])
    {
        return (new BidderEmail($options))->call()->response();
    }

    public function companyRegister($options = [])
    {
        return (new CompanyRegister($options))->call()->response();
    }

    public function consumerRent($options = [])
    {
        return (new ConsumerRent($options))->call()->response();
    }

    public function informationRequest($options = [])
    {
        return (new InformationRequest($options))->call()->response();
    }

    public function __call($method, $arguments){
        if (!method_exists($this, $method)) {
            throw new MyException("Method [{$method}] not exist on " . get_class($this), 1);
        }
    }

    public static function __callStatic($method, $arguments){
        if (!method_exists(self::class, $method)) {
            throw new MyException("Method static [{$method}] not exist on " . get_class(self::class), 1);
        }
    }
}
