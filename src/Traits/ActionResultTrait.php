<?php

namespace PlacetoPay\DeclarationClient\Traits;

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
