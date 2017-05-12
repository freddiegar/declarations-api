<?php

namespace app\Traits;

/**
 * Trait ServiceTrait
 * @package app\Traits
 */
trait FoolTrait
{
    /**
     * @var array
     */
    private $request = [];

    /**
     * @var string
     */
    private $action = null;

    /**
     * @param string $action
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return string
     */
    public function action()
    {
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
     */
    public function request()
    {
        return $this->request;
    }

}
