<?php 

namespace app\Models;

use app\Contracts\ActionInterface;
use app\Contracts\ServiceInterface;
use app\Traits\ActionResultTrait;

class Company extends Service implements ServiceInterface, ActionInterface
{
    use ActionResultTrait;

    public function action()
    {
        return ActionInterface::ACTION_MANAGE_COMPANY;
    }

    public function data()
    {
        return [
            'payload' => [
                'locale' => 'en',
                'documentType' => 'NIT',
                'document' => '800112214',
                'legalName' => 'False Inc.',
                'status' => 'ACTIVE',
                'country' => 'COL',
                'state' => '05',
                'city' => '001',
                'incomeEnable' => [
                    'code' => [
                        'COMPANY_REGISTER',
                    ],
                ],
            ]
        ];
    }
}
