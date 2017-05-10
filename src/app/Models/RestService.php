<?php

namespace app\Models;

use app\Contracts\ServiceInterface;
use app\Exceptions\MyException;

/**
 * Class Service
 * @package app\Models
 */
class RestService implements ServiceInterface
{
    const WSDL = 'http://bender.freddie.dev/declarations/public/api/v1/company-bidders';

    private $authentication = [];

    /**
     * Service constructor.
     * @param array $authentication
     */
    public function __construct(array $authentication = [])
    {
        if (isset($authentication['login']) && isset($authentication['password'])) {
            $this->authentication = $this->authentication($authentication);
        }
    }

    public function authentication(array $authentication)
    {
        return [
            'authorization' => [
                'username' => $authentication['login'],
                'secret' => $authentication['password'],
            ]
        ];
    }

    public function getServiceRequest($action, array $data = [], $isChild = false, $newSpaces = 0)
    {
        if (!is_array($data)) {
            return false;
        }

        return array_merge($this->authentication, $data['payload']);
    }

    public function serviceCall($action, array $data = [])
    {
        $data = array_merge($this->authentication, $data['payload']);

        $headers[] = 'Accept: application/json';
        $headers[] = 'multipart/form-data';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::WSDL);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($curl);

        if ($result === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            throw new MyException('Error CURL: ' . print_r($info, 1));
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
}
