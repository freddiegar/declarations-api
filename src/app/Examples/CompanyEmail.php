<?php 

namespace app\Examples;

use app\Contracts\ActionInterface;
use app\Models\Service;
use app\Traits\ActionResultTrait;

class CompanyEmail extends Service implements ActionInterface
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
                'document' => '900299228',
                'legalName' => 'EGM Ingeniería Sin Fronteras.',
                'status' => 'ACTIVE',
                'country' => 'COL',
                'state' => '05',
                'city' => '001',
                'incomeEnable' => [
                    'code' => [
                        'COMPANY_REGISTER',
                        'CONSUMER_RENT',
                    ],
                ],
                'comercialName' => 'Place to Pay',
                'email' => 'emg@ingenieria.com',
                'telephone' => '4442310',
                'address' => 'Calle 53 # 42-112',
            ]
        ];
    }
}
