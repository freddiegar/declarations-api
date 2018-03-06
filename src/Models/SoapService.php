<?php

namespace PlacetoPay\DeclarationClient\Models;

use PlacetoPay\DeclarationClient\Contracts\ActionInterface;
use PlacetoPay\DeclarationClient\Contracts\ServiceInterface;
use PlacetoPay\DeclarationClient\Exceptions\DeclarationApiException;
use PlacetoPay\DeclarationClient\Traits\HelperTrait;
use PlacetoPay\DeclarationClient\Traits\ServiceInterfaceTrait;
use SoapClient;
use SoapHeader;
use SoapVar;

/**
 * Class SoapService
 * @package app\Models
 */
class SoapService extends SoapClient implements ServiceInterface
{
    use HelperTrait;
    use ServiceInterfaceTrait;

    const WSSE = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd';
    const WSU = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';

    /**
     * @var bool
     */
    private $isCallable = true;

    /**
     * @var string
     */
    private $xml = '';

    /**
     * SoapService constructor.
     * @param string $url
     * @param string $action
     */
    public function __construct($url, $action)
    {
        $this->setUrl($url);
        $this->setAction($action);

        $wsdl = $this->getServiceUrlFromAction();

        $options = [
            'soap_version' => SOAP_1_1,
            'trace' => 1,
            'exceptions' => true,
            'location' => str_replace('?wsdl', '', $wsdl),
            'cache_wsdl' => WSDL_CACHE_NONE,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
        ];

        if (strtolower(substr($wsdl, 0, 5)) == 'https') {
            // Need context when is https
            $options['stream_context'] = stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'crypto_method' => STREAM_CRYPTO_METHOD_TLS_CLIENT
                ]
            ]);
        }

        parent::__construct($wsdl, $options);
    }

    /**
     * @param $xml
     * @return $this
     */
    private function setXml($xml)
    {
        $this->xml = $this->formatXml($xml);

        return $this;
    }

    /**
     * @return string
     */
    private function xml()
    {
        return $this->xml;
    }

    /**
     * @param string $request
     * @param string $location
     * @param string $action
     * @param int $version
     * @param int $one_way
     * @return string
     */
    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {
        $this->setXml($request);

        if ($this->isCallable()) {
            return parent::__doRequest($request, $location, $action, $version, $one_way);
        }

        return '';
    }

    /**
     * Create header for WSSecurity to send data
     * @param array $authentication
     * @return $this
     */
    public function setAuthentication(array $authentication = [])
    {
        if (!isset($authentication['login']) || !isset($authentication['password'])) {
            return $this;
        }

        // WSSecurity
        $nonce = base64_encode(mt_rand());
        $seed = date('c');
        $login = $authentication['login'];
        $password = base64_encode(
            sha1(
                base64_decode($nonce) . $seed . $authentication['password'],
                true
            )
        );

        $UsernameToken = new \stdClass();
        $UsernameToken->Nonce = new SoapVar($nonce, XSD_STRING, null, self::WSSE, null, self::WSSE);
        $UsernameToken->Created = new SoapVar($seed, XSD_STRING, null, self::WSU, null, self::WSU);
        $UsernameToken->Username = new SoapVar($login, XSD_STRING, null, self::WSSE, null, self::WSSE);
        $UsernameToken->Password = new SoapVar($password, XSD_STRING, 'PasswordDigest', null, 'Password', self::WSSE);

        $security = new \stdClass();
        $security->UsernameToken = new SoapVar($UsernameToken, SOAP_ENC_OBJECT, null, self::WSSE, 'UsernameToken', self::WSSE);

        $this->__setSoapHeaders(new SoapHeader(self::WSSE, 'Security', $security, true));

        return $this;
    }

    /**
     * @return string
     */
    public function getServiceRequest()
    {
        $this->disableCall();
        $this->serviceCall();
        $this->enableCall();

        return isConsole() ? $this->xml() : htmlentities($this->xml());
    }

    /**
     * @return mixed
     */
    public function serviceCall()
    {
        return $this->__soapCall($this->action(), [$this->request()]);
    }

    /**
     * @param mixed $response
     * @param string $result
     * @return mixed
     */
    public function serviceResponse($response, $result)
    {
        return $response->{$result};
    }

    private function disableCall()
    {
        $this->isCallable = false;
    }

    private function enableCall()
    {
        $this->isCallable = true;
    }

    private function isCallable()
    {
        return $this->isCallable;
    }

    /**
     * @return string
     * @throws DeclarationApiException
     */
    public function getServiceUrlFromAction()
    {
        $serviceUrl = '';

        switch ($this->action()) {
            case ActionInterface::ACTION_CREATE_REQUEST;
            case ActionInterface::ACTION_INFORMATION_REQUEST;
            case ActionInterface::ACTION_GET_PDF_REQUEST;
            case ActionInterface::ACTION_MANAGE_COMPANY;
            case ActionInterface::ACTION_MANAGE_COMPANY_BIDDER;
                $serviceUrl =  $this->url() . '/api/soap/services?wsdl';
                break;
        }

        if (empty($serviceUrl)) {
            throw new DeclarationApiException('Service URL not valid to [' . $this->action() . '], define it and try again');
        }

        return $serviceUrl;
    }
}
