<?php

namespace app\Models;

use app\Constants\ServiceResponse;
use app\Contracts\ServiceAbstract;
use app\Exceptions\MyException;
use app\Factories\ServiceFactory;
use app\Traits\ActionResultTrait;
use app\Traits\HelperTrait;
use app\Traits\ServiceTrait;
use Exception;
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

    /**
     * Service constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
        $this->service(ServiceFactory::instance($this->serviceType(), $this->url(), $this->action()))
            ->setAuthentication($this->credentials())
            ->setRequest($this->data());
    }

    /**
     * @return $this
     */
    public function call()
    {
        try {
            if ($this->getRequest()) {
                $this->setResponse($this->service()->getServiceRequest());
            }

            if ($this->noMakeCall()) {
                return $this;
            }

            // Call WebService
            $response = $this->service()->serviceResponse(
                $this->service()->serviceCall(),
                $this->actionResult()
            );

            if (!$response) {
                $this->setResponse(sprintf('Response empty from %s', $this->service()->getServiceUrlFromAction()));
            } elseif ($response->status != ServiceResponse::SUCCESS) {
                $this->setResponse($response);
            } else {
                if ($this->saveRequestId() && isset($response->requestId)) {
                    file_put_contents(__DIR__ . '/../../tmp/request.log', $response->requestId);
                }

                $url = (isset($response->redirectTo)) ? $response->redirectTo : null;

                if ($this->isRedirection() && $url) {

                    if (isConsole()) {
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
            $this->setResponse($e->getFile() . '(' . $e->getLine() . '): ' . $e->getMessage(), false);
        } catch (MyException $e) {
            $this->setResponse($e->getFile() . '(' . $e->getLine() . '): ' . $e->getMessage(), false);
        } catch (Exception $e) {
            $this->setResponse($e->getFile() . '(' . $e->getLine() . '): ' . $e->getMessage(), false);
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
