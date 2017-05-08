<?php

namespace app\Models;

use app\Exceptions\MyException;
use SoapFault;

/**
 * Class Service
 * @package app\Models
 */
class Service extends SoapRequest
{
    const WSDL = 'https://bender.freddie.dev/declarations/public/soap/request?wsdl';

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
     * Service constructor.
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->setOptions($options);
        parent::__construct(self::WSDL, $this->authentication());
    }

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
    private function setResponse($response = null, $escapeHtml = true, $append = true)
    {
        $response = print_r($response, 1);

        if (!$append) {
            $this->response = '';
        }

        $this->response .= ($escapeHtml && !$this->isConsole()) ? "<pre>{$response}</pre>" : $response;

        return $this;
    }

    /**
     * @param array $options
     * @return bool
     */
    private function setOptions($options = [])
    {
        foreach ($options as $option) {
            $this->options[$option] = true;
        }

        return true;
    }

    /**
     * @return bool
     */
    private function getXml()
    {
        if (isset($this->options['xml'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    private function getRequest()
    {
        if (isset($this->options['request'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    private function isRedirection()
    {
        if (isset($this->options['redirect'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    private function saveRequestId()
    {
        if (isset($this->options['save'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    private function makeLink()
    {
        if (isset($this->options['link'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    private function noMakeCall()
    {
        if (isset($this->options['no-call'])) {
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function authentication()
    {
        return [
            'login' => $this->login(),
            'password' => $this->password(),
        ];
    }

    /**
     * @return $this
     */
    public function call()
    {
        try {

            $data = $this->data();
            $action = $this->action();
            $result = $this->actionResult();

            if ($this->getXml()) {
                $this->setResponse($this->getXmlFromArray($action, $data));
            }

            if ($this->noMakeCall()) {
                return $this;
            }

            // Call WebService
            $tmp = $this->__soapCall($action, [$data]);

            if ($this->getRequest()) {
                $this->setResponse(htmlentities($this::__getLastRequest()), 1);
            }

            if ($tmp->{$result}->status != 'SUCCESS') {
                $this->setResponse($tmp->{$result}->message);
            } else {
                if ($this->saveRequestId() && isset($tmp->{$result}->requestId)) {
                    file_put_contents(__DIR__ . '/../../tmp/request.log', $tmp->{$result}->requestId);
                }

                $url = (isset($tmp->{$result}->redirectTo)) ? $tmp->{$result}->redirectTo : null;

                if ($this->isRedirection() && $url) {

                    if ($this->isConsole()) {
                        // On console
                        $this->setResponse('Going to: ' . $url, false);
                    }

                    // On browser
                    header('Location: ' . $url);
                } else {
                    $this->setResponse($tmp);
                }

                if ($this->makeLink() && $url) {
                    $this->setResponse(sprintf('<a href="%s" target="_blank">Open in new tab</a>', $url), false);
                }
            }
        } catch (SoapFault $e) {
            $this->setResponse($e->getMessage(), false);
        } catch (MyException $e) {
            $this->setResponse($e->getMessage(), false);
        }

        return $this;
    }
}
