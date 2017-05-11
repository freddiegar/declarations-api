<?php

namespace app\Traits;

/**
 * Trait ActionResultTrait
 * @package app\Traits
 */
trait ActionResultTrait
{
    public function actionResult()
    {
        return $this->action() . 'Result';
    }
}
