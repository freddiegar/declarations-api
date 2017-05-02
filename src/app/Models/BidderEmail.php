<?php 

namespace app\Models;

use app\Contracts\ActionInterface;
use app\Contracts\ServiceInterface;
use app\Traits\ActionResultTrait;

class BidderEmail extends Service implements ServiceInterface, ActionInterface
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
                'companyDocument' => '900299228',
                'documentType' => 'CC',
                'document' => '1022000000',
                'bidderPosition' => '1',
                'incomeEnable' => [
                    'code' => [
                        'COMPANY_REGISTER',
                        'CONSUMER_RENT',
                    ],
                ],
                'name' => 'Fredy',
                'surname' => 'Mendivelso',
                'email' => 'fredy@mendivelso.com',
                'telephone' => '3211234567',
            ]
        ];
    }
}
