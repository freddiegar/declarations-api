<?php

namespace FreddieGar\DeclarationApi\Examples;

use FreddieGar\DeclarationApi\Contracts\ActionInterface;
use FreddieGar\DeclarationApi\Models\Service;

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
                'locale' => 'es',
                'requestId' => (file_exists($file)) ? file_get_contents($file) : '',
            ]
        ];
    }
}
