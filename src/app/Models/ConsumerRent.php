<?php 

namespace app\Models;

use app\Contracts\ActionInterface;
use app\Contracts\ServiceInterface;
use app\Traits\ActionResultTrait;
use app\Traits\ReturnUrlTrait;

class ConsumerRent extends Service implements ServiceInterface, ActionInterface
{
    use ActionResultTrait;
    use ReturnUrlTrait;

    public function action()
    {
        return ActionInterface::ACTION_CREATE_REQUEST;
    }

    public function data()
    {
        return [
            'payload' => [
                'locale' => 'en',
                'incomeType' => 'CONSUMER_RENT',
                'companyDocument' => '900299228',
                'companyDocumentType' => 'NIT',
                'payment' => [
                    'amount' => rand(1000000, 2000000),
                ],
                'returnUrl' => $this->returnUrl(),
            ]
        ];
    }
}
