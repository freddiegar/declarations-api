<?php

namespace app\Traits;

use app\Constants\ServiceType;

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
     * @return bool
     */
    protected function setOptions($options = [])
    {
        foreach ($options as $option) {
            $this->options[$option] = true;
        }

        return true;
    }

    /**
     * @return bool
     */
    protected function getRequest()
    {
        if (isset($this->options['request'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    protected function isRedirection()
    {
        if (isset($this->options['redirect'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    protected function saveRequestId()
    {
        if (isset($this->options['save'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    protected function makeLink()
    {
        if (isset($this->options['link'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    protected function noMakeCall()
    {
        if (isset($this->options['no-call'])) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    protected function serviceType(){
        return ($this->isServiceRest()) ? ServiceType::REST : ServiceType::SOAP;
    }

    /**
     * @return bool
     */
    protected function isServiceSoap(){
        if (isset($this->options['soap'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    protected function isServiceRest(){
        if (isset($this->options['rest'])) {
            return true;
        }

        return false;
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
