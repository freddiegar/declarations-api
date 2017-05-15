<?php

namespace app\Traits;

use app\Constants\Command;
use app\Constants\ServiceType;

/**
 * Trait ServiceTrait
 * @package app\Traits
 */
trait ServiceTrait
{
    /**
     * @var string
     */
    private $login = 'Xei3cZAwqn';

    /**
     * @var string
     */
    private $password = '9RPqFU1EIC326BpPX45Fk4WsIoOmc7EnfmxGZhvu';

    /**
     * @var string
     */
    private $url = 'https://dev.placetopay.com/autodeclaraciones';
//    private $url = 'https://bender.freddie.dev/declarations/public';

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
        return $this->login;
    }

    /**
     * @return string
     */
    public function password()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function url()
    {
        return $this->url;
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

        $this->response .= ($escapeHtml && !$this->isConsole()) ? "<pre>{$response}</pre><br/>" : $response . PHP_EOL;

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
}
