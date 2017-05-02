<?php 

namespace app\Models;

use app\Contracts\ServiceInterface;

class BidderEmail extends Service implements ServiceInterface
{
    const ACTION = 'manageCompanyBidder';

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
