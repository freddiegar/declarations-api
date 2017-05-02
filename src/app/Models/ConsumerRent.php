<?php 

namespace app\Models;

use app\Contracts\ServiceInterface;

class ConsumerRent extends Service implements ServiceInterface
{
    const ACTION = 'createRequest';

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
                'returnUrl' => 'https://www.google.com.co/',
            ]
        ];
    }
}
