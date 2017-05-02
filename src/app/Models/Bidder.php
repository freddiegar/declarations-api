<?php 

namespace app\Models;

use app\Contracts\ServiceInterface;

class Bidder extends Service implements ServiceInterface
{
    const ACTION = 'manageCompanyBidder';

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
