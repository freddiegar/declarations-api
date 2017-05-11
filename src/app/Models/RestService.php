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
        $this->authentication($authentication);
    }

    /**
     * @param array $authentication
     * @return array|bool
     */
    public function authentication(array $authentication = [])
    {
        if (!isset($authentication['login']) || !isset($authentication['password'])) {
            return false;
        }

        return $this->authentication = [
            'authorization' => [
                'username' => $authentication['login'],
                'secret' => $authentication['password'],
            ]
        ];
    }

    /**
     * @param $action
     * @param array $data
     * @param bool $isChild
     * @param int $newSpaces
     * @return array|bool
     */
    public function getServiceRequest($action, array $data = [], $isChild = false, $newSpaces = 0)
    {
        if (!is_array($data)) {
            return false;
        }

        return array_merge($this->authentication, $data['payload']);
    }

    /**
     * @param string $action
     * @param array $data
     * @return mixed
     * @throws MyException
     */
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
            throw new MyException('Error: ' . $decoded->error);
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
