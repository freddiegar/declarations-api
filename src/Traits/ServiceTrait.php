<?php

namespace FreddieGar\DeclarationApi\Traits;

use FreddieGar\DeclarationApi\Constants\Command;
use FreddieGar\DeclarationApi\Constants\ServiceType;
use FreddieGar\DeclarationApi\Contracts\ServiceInterface;

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
     * @var string
     */
    private $login = null;

    /**
     * @var string
     */
    private $password = null;

    /**
     * @var string
     */
    private $url = null;

    /**
     * @param null $login
     * @return $this|null
     */
    public function login($login = null)
    {
        if (!is_null($login)) {
            $this->login = $login;
            return $this;
        }

        return env('SERVICE_LOGIN', $this->login);
    }

    /**
     * @param null $password
     * @return $this|null
     */
    public function password($password = null)
    {
        if (!is_null($password)) {
            $this->password = $password;
            return $this;
        }

        return env('SERVICE_PASSWORD', $this->password);
    }

    /**
     * @param null $url
     * @return $this|null
     */
    public function url($url = null)
    {
        if (!is_null($url)) {
            $this->url = $url;
            return $this;
        }

        return env('SERVICE_URL', $this->url);
    }

    /**
     * @param null $response
     * @return mixed
     */
    public function response($response = null)
    {
        if (!is_null($response)) {
            $this->response = $response;
            return $this;
        }

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
        if (!is_string($response)) {
            $response = json_encode($response, JSON_PRETTY_PRINT);
        }

        if (!$append) {
            $this->response = '';
        }

        $this->response .= (($escapeHtml && !isConsole()) ? "<pre>{$response}</pre>" : $response) . breakLine();

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
        if (!is_null($service)) {
            $this->service = $service;
        }

        return $this->service;
    }
}
