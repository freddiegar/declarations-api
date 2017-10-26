<?php

namespace FreddieGar\DeclarationApi\Examples;

use FreddieGar\DeclarationApi\Contracts\ActionInterface;
use FreddieGar\DeclarationApi\Models\Service;

/**
 * Class BidderEmail
 * @package app\Examples
 */
class BidderEmail extends Service
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
                'locale' => 'es',
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
                // Optional
                'name' => 'Fredy',
                'surname' => 'Mendivelso',
                'email' => 'fredy.mendivelso@placetopay.com',
                'telephone' => '3211234567',
            ]
        ];
    }
}
