<?php

namespace app\Traits;

trait ActionResultTrait
{
    public function actionResult()
    {
        return $this->action() . 'Result';
    }
}
