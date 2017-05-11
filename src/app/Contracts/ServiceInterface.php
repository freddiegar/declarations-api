<?php

namespace app\Contracts;

interface ServiceInterface
{
    /**
     * @param array $authentication
     * @return mixed
     */
    public function authentication(array $authentication = []);

    /**
     * @param $action
     * @param array $data
     * @param bool $isChild
     * @param int $newSpaces
     * @return mixed
     */
    public function getServiceRequest($action, array $data = [], $isChild = false, $newSpaces = 0);

    /**
     * @param string $action
     * @param array $data
     * @return mixed
     */
    public function serviceCall($action, array $data);

    /**
     * @param mixed $response
     * @param string $result
     * @return mixed
     */
    public function serviceResponse($response, $result);
}
