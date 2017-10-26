<?php

namespace FreddieGar\DeclarationApi\Traits;

use FreddieGar\DeclarationApi\Exceptions\MyException;

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
     * @throws MyException
     */
    public function url()
    {
        if (empty($this->url)) {
            throw new MyException('Url not defined to ' . get_called_class());
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
     * @throws MyException
     */
    public function action()
    {
        if (empty($this->action)) {
            throw new MyException('Action not defined to ' . get_called_class());
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
     * @throws MyException
     */
    public function request()
    {
        if (empty($this->request)) {
            throw new MyException('Request not defined to ' . get_called_class());
        }

        return $this->request;
    }
}
