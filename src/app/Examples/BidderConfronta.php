<?php

namespace app\Examples;

use app\Contracts\ActionInterface;
use app\Models\Service;

/**
 * Class BidderConfronta
 * @package app\Examples
 */
class BidderConfronta extends Service
{
    /**
     * @return string
     */
    public function action()
    {
        return ActionInterface::ACTION_MANAGE_COMPANY_BIDDER;
    }

    /**
     * @return array
     */
    public function data()
    {
        return [
            'payload' => [
                'locale' => 'es',
                'companyDocumentType' => 'NIT',
                'companyDocument' => '900299228',
                'documentType' => 'CC',
                'document' => '1023000000',
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
