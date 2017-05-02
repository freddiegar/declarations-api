<?php 

namespace app\Models;

use app\Contracts\ActionInterface;
use app\Contracts\ServiceInterface;
use app\Traits\ActionResultTrait;

class InformationRequest extends Service implements ServiceInterface, ActionInterface
{
    use ActionResultTrait;

    public function action()
    {
        return ActionInterface::ACTION_INFORMATION_REQUEST;
    }

    public function data()
    {

        $file = __DIR__ . '/../../tmp/request.log';
        $requestId = '';

        if (file_exists($file)) {
            $requestId = file_get_contents($file);
        }

        return [
            'payload' => [
                'locale' => 'es',
                'requestId' => $requestId,
            ]
        ];
    }
}
