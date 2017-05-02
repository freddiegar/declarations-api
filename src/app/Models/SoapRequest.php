<?php

namespace app\Models;

use SoapClient;
use SoapHeader;
use SoapVar;

class SoapRequest extends SoapClient
{
    const WSSE = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd';
    const WSU = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';

    public function __construct($wsdl, array $auth = [])
    {

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

        if (isset($auth['login']) && isset($auth['password'])) {
            $this->__setSoapHeaders($this->wsSecurity($auth));
        }

        unset($auth, $options);
    }

    /**
     * Create header for WSSecurity to send data
     * @param $auth
     * @return SoapHeader
     */
    protected function WsSecurity($auth)
    {
        // WSSecurity
        $nonce = base64_encode(mt_rand());
        $seed = date('c');
        $login = $auth['login'];
        $password = base64_encode(
            sha1(
                base64_decode($nonce) . $seed . $auth['password'],
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

        return new SoapHeader(self::WSSE, 'Security', $security, true);
    }

    /**
     * @param $action
     * @param array $data
     * @param bool $isChild
     * @param int $newSpaces
     * @return array|bool|string
     */
    protected function getXmlFromArray($action, array $data = [], $isChild = false, $newSpaces = 0)
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
                    $payload[] = $this->getXmlFromArray($key, $value, true, 4);
                    $payload[] = $this->getSpaces($spaces) . "</{$key}>";
                } else {
                    $payload[] = $this->getXmlFromArray($key, $value, true, 4);
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
     * @param int $multiplier
     * @return string
     */
    private function getSpaces($multiplier = 0)
    {
        return str_repeat(' ', $multiplier);
    }

    /**
     * @return bool
     */
    protected function isConsole()
    {
        if ('cli' == php_sapi_name()) {
            return true;
        }

        return false;
    }
}
