<?php

namespace PlacetoPay\DeclarationClient\Examples;

use PlacetoPay\DeclarationClient\Contracts\ActionInterface;
use PlacetoPay\DeclarationClient\Models\Service;

/**
 * Class BidderConfronta
 * @package app\Examples
 */
class BidderConfronta extends Service
{
    /**
     * @return string
     */
    public function action($action = null)
    {
        return ActionInterface::ACTION_MANAGE_COMPANY_BIDDER;
    }

    /**
     * @return array
     */
    public function data($data = null)
    {
        return [
            'payload' => [
                'locale' => 'es-CO',
                'companyDocumentType' => 'NIT',
                'companyDocument' => '900000000',
                'documentType' => 'CC',
                'document' => '1023000000',
                'bidderPosition' => '1',
                'incomeEnable' => [
                    'code' => [
                        'COMPANY_REGISTER',
                        'CONSUMER_BEER',
                    ],
                ],
            ]
        ];
    }
}
