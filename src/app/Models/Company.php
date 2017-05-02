<?php 

namespace app\Models;

use app\Contracts\ServiceInterface;

class Company extends Service implements ServiceInterface
{
    const ACTION = 'manageCompany';

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
