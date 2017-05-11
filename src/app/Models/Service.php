<?php

namespace app\Models;

use app\Factories\ServiceFactory;
use app\Constants\ServiceResponse;
use app\Contracts\ServiceAbstract;
use app\Exceptions\MyException;
use app\Traits\ActionResultTrait;
use app\Traits\HelperTrait;
use app\Traits\ServiceTrait;
use SoapFault;

/**
 * Class Service
 * @package app\Models
 */
abstract class Service extends ServiceAbstract
{
    use ServiceTrait;
    use ActionResultTrait;
    use HelperTrait;

    private $service = null;

    /**
     * Service constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
        $this->service = ServiceFactory::instance($this->credentials(), $this->serviceType());
    }

    /**
     * @return $this
     */
    public function call()
    {
        try {
            $data = $this->data();
            $action = $this->action();

            if ($this->getRequest()) {
                $this->setResponse($this->service->getServiceRequest($action, $data));
            }

            if ($this->noMakeCall()) {
                return $this;
            }

            // Call WebService
            $response = $this->service->serviceResponse(
                $this->service->serviceCall($action, $data),
                $this->actionResult()
            );

            if ($response->status != ServiceResponse::SUCCESS) {
                $this->setResponse($response->message);
            } else {
                if ($this->saveRequestId() && isset($response->requestId)) {
                    file_put_contents(__DIR__ . '/../../tmp/request.log', $response->requestId);
                }

                $url = (isset($response->redirectTo)) ? $response->redirectTo : null;

                if ($this->isRedirection() && $url) {

                    if ($this->isConsole()) {
                        // On console
                        $this->setResponse('Going to: ' . $url, false);
                    }

                    // On browser
                    header('Location: ' . $url);
                } else {
                    $this->setResponse($response);
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

    /**
     * @return string
     */
    abstract public function action();

    /**
     * @return array
     */
    abstract public function data();
}
