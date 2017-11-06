<?php

namespace FreddieGar\DeclarationApi\Models;

use FreddieGar\DeclarationApi\Contracts\ActionInterface;
use FreddieGar\DeclarationApi\Contracts\ServiceInterface;
use FreddieGar\DeclarationApi\Exceptions\DeclarationApiException;
use FreddieGar\DeclarationApi\Traits\ServiceInterfaceTrait;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

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
     * @return object
     * @throws DeclarationApiException
     */
    public function serviceCall()
    {
        try {
            $client = new Client([
                'base_uri' => $this->url(),
                'verify' => false,
                'timeout' => 10,
                'allow_redirects' => true,
            ]);
            $response = $client->post($this->getServiceUrlFromAction(), [
                'json' => $this->request(),
            ]);

            $result = $response->getBody()->getContents();
        } catch (\Exception $e) {
            throw new DeclarationApiException($e->getMessage());
        }

        if ($result === false) {
            throw new DeclarationApiException('Response empty from ' . $this->getServiceUrlFromAction() . '. Not connection to server?');
        }

        $decoded = json_decode($result);

        if (isset($decoded->error)) {
            throw new DeclarationApiException($decoded->error);
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
     * @throws DeclarationApiException
     */
    public function getServiceUrlFromAction()
    {
        $url = $this->url();

        switch ($this->action()) {
            case ActionInterface::ACTION_CREATE_REQUEST;
                $serviceUrl = $url . '/api/v1/income-request';
                break;
            case ActionInterface::ACTION_INFORMATION_REQUEST;
                $serviceUrl = $url . '/api/v1/information-request';
                break;
            case ActionInterface::ACTION_GET_PDF_REQUEST;
                $serviceUrl = $url . '/api/v1/income-pdf';
                break;
            case ActionInterface::ACTION_MANAGE_COMPANY;
                $serviceUrl = $url . '/api/v1/companies';
                break;
            case ActionInterface::ACTION_MANAGE_COMPANY_BIDDER;
                $serviceUrl = $url . '/api/v1/company-bidders';
                break;
            default:
                throw new DeclarationApiException('Service URL not valid to [' . $this->action() . '], define it and try again');
                break;

        }

        return $serviceUrl;
    }
}
