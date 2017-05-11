<?php

namespace app\Models;

use app\Contracts\ServiceInterface;
use app\Traits\HelperTrait;
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

    const WSDL = 'https://bender.freddie.dev/declarations/public/soap/request?wsdl';
    const WSSE = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd';
    const WSU = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';

    public function __construct(array $authentication = [])
    {
        $wsdl = self::WSDL;

        $options = [
            'soap_version' => SOAP_1_2,
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

        $this->authentication($authentication);
    }

    /**
     * Create header for WSSecurity to send data
     * @param array $authentication
     * @return bool|SoapHeader
     */
    public function authentication(array $authentication = [])
    {
        if (!isset($authentication['login']) || !isset($authentication['password'])) {
            return false;
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

        return $this->__setSoapHeaders(new SoapHeader(self::WSSE, 'Security', $security, true));
    }

    /**
     * @param $action
     * @param array $data
     * @param bool $isChild
     * @param int $newSpaces
     * @return array|bool|string
     */
    public function getServiceRequest($action, array $data = [], $isChild = false, $newSpaces = 0)
    {
        if (!is_array($data)) {
            return false;
        }

        $payload = [];
        static $spaces = 12;
        $spaces += $newSpaces;

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (!isset($value[0])) {
                    $payload[] = $this->getSpaces($spaces) . "<{$key}>";
                    $payload[] = $this->getServiceRequest($key, $value, true, 4);
                    $payload[] = $this->getSpaces($spaces) . "</{$key}>";
                } else {
                    $payload[] = $this->getServiceRequest($key, $value, true, 4);
                }
                continue;
            }

            if (is_int($key) && $isChild) {
                $spaces -= $newSpaces;
                $payload[] = $this->getSpaces($spaces) . "<{$action}>{$value}</{$action}>";
                $spaces += $newSpaces;
                continue;
            }

            $payload[] = $this->getSpaces($spaces) . "<{$key}>{$value}</{$key}>";
        }

        $payload = implode("\n", $payload);

        $spaces -= $newSpaces;

        if ($isChild) {
            return $payload;
        }

        $xml = <<<SOAP
<?xml version="1.0" encoding="UTF-8"?>
<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
    <Body>
        <$action xmlns="http://localhost/">
$payload
        </$action>
    </Body>
</Envelope>
SOAP;

        return $this->isConsole() ? $xml : htmlentities($xml);
    }

    /**
     * @param $action
     * @param array $data
     * @return mixed
     */
    public function serviceCall($action, array $data)
    {
        return $this->__soapCall($action, [$data]);
    }

    /**
     * @param int $multiplier
     * @return string
     */
    private function getSpaces($multiplier = 0)
    {
        return str_repeat(' ', $multiplier);
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
}
