<?php

namespace PlacetoPay\DeclarationClient\Traits;

use PlacetoPay\DeclarationClient\Exceptions\DeclarationClientException;

/**
 * Trait ServiceTrait
 * @package app\Traits
 */
trait ServiceInterfaceTrait
{
    /**
     * @var string
     */
    private $url = null;

    /**
     * @var string
     */
    private $action = null;

    /**
     * @var array
     */
    private $request = [];


    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = rtrim(trim($url), '/');
        return $this;
    }

    /**
     * @return string
     * @throws DeclarationClientException
     */
    public function url()
    {
        if (empty($this->url)) {
            throw new DeclarationClientException('Url not defined to ' . get_called_class());
        }

        return $this->url;
    }

    /**
     * @param string $action
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = trim($action);
        return $this;
    }

    /**
     * @return string
     * @throws DeclarationClientException
     */
    public function action()
    {
        if (empty($this->action)) {
            throw new DeclarationClientException('Action not defined to ' . get_called_class());
        }

        return $this->action;
    }

    /**
     * @param array $request
     * @return $this
     */
    public function setRequest(array $request = [])
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return array
     * @throws DeclarationClientException
     */
    public function request()
    {
        if (empty($this->request)) {
            throw new DeclarationClientException('Request not defined to ' . get_called_class());
        }

        return $this->request;
    }
}
