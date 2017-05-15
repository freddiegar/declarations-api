<?php

namespace app\Examples;

use app\Contracts\ActionInterface;
use app\Models\Service;

/**
 * Class BidderEmail
 * @package app\Examples
 */
class BidderError extends Service
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
                'locale' => 'en',
                'companyDocumentType' => 'NIT',
                'companyDocument' => '900299228',
                'documentType' => 'CC',
                'document' => '900000000',
                'bidderPosition' => '1',
                'name' => 'Jon',
                'surname' => 'Doe',
                'email' => 'jon@doe.com',
                'telephone' => '3211234567',
            ]
        ];
    }
}
