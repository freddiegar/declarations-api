<?php

namespace app\Traits;

use app\Constants\Command;
use app\Constants\ServiceType;
use app\Contracts\ServiceInterface;

/**
 * Trait ServiceTrait
 * @package app\Traits
 */
trait ServiceTrait
{

    /**
     * @var ServiceInterface
     */
    private $service = null;

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var mixed
     */
    private $response = null;

    /**
     * @return string
     */
    public function login()
    {
        return env('SERVICE_LOGIN', '');
    }

    /**
     * @return string
     */
    public function password()
    {
        return env('SERVICE_PASSWORD', '');
    }

    /**
     * @return string
     */
    public function url()
    {
        return env('SERVICE_URL', '');
    }

    /**
     * @return mixed
     */
    public function response()
    {
        return $this->response;
    }

    /**
     * @param null $response
     * @param bool $escapeHtml
     * @param bool $append
     * @return $this
     */
    protected function setResponse($response = null, $escapeHtml = true, $append = true)
    {
        $response = print_r($response, 1);

        if (!$append) {
            $this->response = '';
        }

        $this->response .= ($escapeHtml && !isConsole()) ? "<pre>{$response}</pre><br/>" : $response . PHP_EOL;

        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    protected function setOptions(array $options = [])
    {
        foreach ($options as $option) {
            $this->options[$option] = true;
        }

        return $this;
    }

    /**
     * @return bool
     */
    protected function getRequest()
    {
        return isset($this->options[Command::REQUEST]);
    }

    /**
     * @return bool
     */
    protected function isRedirection()
    {
        return isset($this->options[Command::REDIRECT]);
    }

    /**
     * @return bool
     */
    protected function saveRequestId()
    {
        return isset($this->options[Command::SAVE]);
    }

    /**
     * @return bool
     */
    protected function makeLink()
    {
        return isset($this->options[Command::LINK]);
    }

    /**
     * @return bool
     */
    protected function noMakeCall()
    {
        return isset($this->options[Command::NO_CALL]);
    }

    /**
     * @return bool
     */
    protected function isServiceSoap()
    {
        return isset($this->options[Command::SOAP]);
    }

    /**
     * @return bool
     */
    protected function isServiceRest()
    {
        return isset($this->options[Command::REST]);
    }

    /**
     * @return string
     */
    protected function serviceType()
    {
        return ($this->isServiceSoap()) ? ServiceType::SOAP : ServiceType::REST;
    }

    /**
     * @return array
     */
    protected function credentials()
    {
        return [
            'login' => $this->login(),
            'password' => $this->password(),
        ];
    }

    /**
     * @param null $service
     * @return ServiceInterface
     */
    protected function service($service = null)
    {
        if(!is_null($service)){
            $this->service = $service;
        }

        return $this->service;
    }
}
