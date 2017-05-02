<?php 

namespace app\Models;

use app\Contracts\ActionInterface;
use app\Contracts\ServiceInterface;
use app\Traits\ActionResultTrait;

class Bidder extends Service implements ServiceInterface, ActionInterface
{
    use ActionResultTrait;

    public function action()
    {
        return ActionInterface::ACTION_MANAGE_COMPANY_BIDDER;
    }

    public function data()
    {
        return [
            'payload' => [
                'locale' => 'en',
                'companyDocumentType' => 'NIT',
                'companyDocument' => '800112214',
                'documentType' => 'CC',
                'document' => '1022000004',
                'bidderPosition' => '1',
                'incomeEnable' => [
                    'code' => [
                        'COMPANY_REGISTER',
                        'CONSUMER_RENT',
                    ],
                ],
            ]
        ];
    }
}
