<?php

namespace app\Models;

use app\Contracts\ActionInterface;
use app\Contracts\ServiceInterface;
use app\Exceptions\MyException;
use app\Traits\ServiceInterfaceTrait;

/**
 * Class Service
 * @package app\Models
 */
class RestService implements ServiceInterface
{
    use ServiceInterfaceTrait;

    /**
     * @var array
     */
    private $authentication = [];

    /**
     * RestService constructor.
     * @param $url
     * @param $action
     */
    function __construct($url, $action)
    {
        $this->setUrl($url);
        $this->setAction($action);
    }

    /**
     * @return array
     */
    public function request()
    {
        return array_merge($this->authentication, $this->request['payload']);
    }

    /**
     * @param array $authentication
     * @return $this
     */
    public function setAuthentication(array $authentication = [])
    {
        if (isset($authentication['login']) && isset($authentication['password'])) {
            $this->authentication = [
                'authorization' => [
                    'username' => $authentication['login'],
                    'secret' => $authentication['password'],
                ]
            ];
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getServiceRequest()
    {
        return json_encode($this->request(), JSON_PRETTY_PRINT);
    }

    /**
     * @return mixed
     * @throws MyException
     */
    public function serviceCall()
    {
        $headers[] = 'Accept: application/json';
        $headers[] = 'multipart/form-data';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->getServiceUrlFromAction());
        curl_setopt($curl, CURLOPT_USERAGENT, 'curl ' . (curl_version())['version']);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->request()));
        $result = curl_exec($curl);

        if ($result === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            throw new MyException($info);
        }

        curl_close($curl);

        $decoded = json_decode($result);
        if (isset($decoded->error)) {
            throw new MyException($decoded->error);
        }

        return $decoded;
    }

    /**
     * @param mixed $response
     * @param string $result
     * @return mixed
     */
    public function serviceResponse($response, $result)
    {
        return $response;
    }

    /**
     * @return string
     * @throws MyException
     */
    public function getServiceUrlFromAction()
    {
        $url = $this->url();
        $serviceUrl = '';

        switch ($this->action()) {
            case ActionInterface::ACTION_CREATE_REQUEST;
                $serviceUrl = $url . '/api/v1/income-request';
                break;
            case ActionInterface::ACTION_INFORMATION_REQUEST;
                $serviceUrl = $url . '/api/v1/information-request';
                break;
            case ActionInterface::ACTION_MANAGE_COMPANY;
                $serviceUrl = $url . '/api/v1/companies';
                break;
            case ActionInterface::ACTION_MANAGE_COMPANY_BIDDER;
                $serviceUrl = $url . '/api/v1/company-bidders';
                break;
            default:
                throw new MyException('Service URL not valid to [' . $this->action() . '], define it and try again');
                break;

        }

        return $serviceUrl;
    }
}
