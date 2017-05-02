<?php

namespace app\Models;

use app\Exceptions\MyException;
use SoapFault;

class Service extends SoapRequest
{
    const WSDL = 'https://bender.freddie.dev/declarations/public/soap/request?wsdl';

    private $login = 'Xei3cZAwqn';
    private $password = '9RPqFU1EIC326BpPX45Fk4WsIoOmc7EnfmxGZhvu';
    private $options = [];
    private $response = null;

    public function __construct($options = [])
    {
        $this->setOptions($options);
        parent::__construct(self::WSDL, $this->authentication());
    }

    public function login()
    {
        return $this->login;
    }

    public function password()
    {
        return $this->password;
    }

    public function response()
    {
        return $this->response;
    }

    private function setResponse($response = null, $isHtml = false, $append = false)
    {
        $response = print_r($response, 1);

        if (!$append) {
            $this->response = '';
        }

        $this->response .= ($isHtml && !$this->isConsole()) ? "<pre>{$response}</pre>" : $response;

        return $this;
    }

    private function setOptions($options = [])
    {
        foreach ($options as $option) {
            $this->options[$option] = true;
        }

        return true;
    }

    private function getXml()
    {
        if (isset($this->options['xml'])) {
            return true;
        }

        return false;
    }

    private function isRedirection()
    {
        if (isset($this->options['redirect'])) {
            return true;
        }

        return false;
    }

    private function saveRequestId()
    {
        if (isset($this->options['save'])) {
            return true;
        }

        return false;
    }

    public function authentication()
    {
        return [
            'login' => $this->login(),
            'password' => $this->password(),
        ];
    }

    public function call()
    {
        try {

            $data = $this->data();
            $action = $this->action();
            $result = $this->actionResult();
            $tmp = $this->__soapCall($action, [$data]);

            if ($tmp->{$result}->status != 'SUCCESS') {
                $this->setResponse($tmp->{$result}->message, true);
            } else {
                if ($this->saveRequestId() && isset($tmp->{$result}->requestId)) {
                    file_put_contents(__DIR__ . '/../../tmp/request.log', $tmp->{$result}->requestId);
                }

                if ($this->isRedirection() && isset($tmp->{$result}->redirectTo)) {
                    $url = $tmp->{$result}->redirectTo;

                    if ($this->isConsole()) {
                        // It is console
                        $this->setResponse('Going to: ' . $url);
                    }

                    // On browser
                    header('Location: ' . $url);
                } else {
                    $this->setResponse($tmp, true);
                }
            }

            if ($this->getXml()) {
                $this->setResponse($this->getXmlFromArray($action, $data), true, true);
                // $tmp = $this->__soapCall($action, [$data]);
                // $this->setResponse(htmlentities($this::__getLastRequest()), 1);
            }
        } catch (SoapFault $e) {
            $this->setResponse($e->getMessage());
        } catch (MyException $e) {
            $this->setResponse($e->getMessage());
        }

        return $this;
    }
}
