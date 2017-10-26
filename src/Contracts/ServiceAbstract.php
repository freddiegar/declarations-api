<?php

namespace FreddieGar\DeclarationApi\Contracts;

/**
 * Class ServiceAbstract
 * @package app\Contracts
 */
abstract class ServiceAbstract
{
    /**
     * @param null $login
     * @return string
     */
    abstract public function login($login = null);

    /**
     * @param null $password
     * @return string
     */
    abstract public function password($password = null);

    /**
     * @param null $url
     * @return string
     */
    abstract public function url($url = null);

    /**
     * @param null $response
     * @return mixed
     */
    abstract public function response($response = null);

    /**
     * @param null $response
     * @param bool $escapeHtml
     * @param bool $append
     * @return $this
     */
    abstract protected function setResponse($response = null, $escapeHtml = true, $append = true);

    /**
     * @param array $options
     * @return bool
     */
    abstract protected function setOptions(array $options = []);

    /**
     * @return bool
     */
    abstract protected function getRequest();

    /**
     * @return bool
     */
    abstract protected function isRedirection();

    /**
     * @return bool
     */
    abstract protected function saveRequestId();

    /**
     * @return bool
     */
    abstract protected function makeLink();

    /**
     * @return bool
     */
    abstract protected function noMakeCall();

    /**
     * @return string
     */
    abstract protected function serviceType();

    /**
     * @return bool
     */
    abstract protected function isServiceSoap();

    /**
     * @return bool
     */
    abstract protected function isServiceRest();

    /**
     * @return array
     */
    abstract protected function credentials();

    /**
     * @return $this
     */
    abstract protected function call();

    /**
     * @param null $service
     * @return mixed
     */
    abstract protected function service($service = null);
}
