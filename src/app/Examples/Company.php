<?php 

namespace app\Examples;

use app\Contracts\ActionInterface;
use app\Models\Service;
use app\Traits\ActionResultTrait;

class Company extends Service implements ActionInterface
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
