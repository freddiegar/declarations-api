<?php

namespace FreddieGar\DeclarationApi\Contracts;

interface ServiceInterface
{
    /**
     * @param $action
     * @return $this
     */
    public function setAction($action);

    /**
     * @return string
     */
    public function action();

    /**
     * @param $request
     * @return $this
     */
    public function setRequest(array $request = []);

    /**
     * @return array
     */
    public function request();

    /**
     * @param array $authentication
     * @return $this
     */
    public function setAuthentication(array $authentication = []);

    /**
     * @return mixed
     */
    public function getServiceRequest();

    /**
     * @return mixed
     */
    public function serviceCall();

    /**
     * @param mixed $response
     * @param string $result
     * @return mixed
     */
    public function serviceResponse($response, $result);

    /**
     * @return string
     */
    public function getServiceUrlFromAction();
}
