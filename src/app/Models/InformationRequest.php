<?php 

namespace app\Models;

use app\Contracts\ServiceInterface;

class InformationRequest extends Service implements ServiceInterface
{
    const ACTION = 'informationRequest';

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
