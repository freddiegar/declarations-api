<?php

namespace PlacetoPay\DeclarationClient\Examples;

use PlacetoPay\DeclarationClient\Contracts\ActionInterface;
use PlacetoPay\DeclarationClient\Models\Service;

/**
 * Class InformationRequest
 * @package app\Examples
 */
class InformationRequest extends Service
{
    /**
     * @return string
     */
    public function action($action = null)
    {
        return ActionInterface::ACTION_INFORMATION_REQUEST;
    }

    /**
     * @return array
     */
    public function data($data = null)
    {
        $file = __DIR__ . '/../../examples/tmp/request.log';

        return [
            'payload' => [
                'locale' => 'es-CO',
                'requestId' => (file_exists($file)) ? file_get_contents($file) : '',
            ]
        ];
    }
}
