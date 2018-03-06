<?php 

namespace PlacetoPay\DeclarationClient\Examples;

use PlacetoPay\DeclarationClient\Contracts\ActionInterface;
use PlacetoPay\DeclarationClient\Models\Service;

/**
 * Class Company
 * @package app\Examples
 */
class Company extends Service
{
    /**
     * @return string
     */
    public function action($action = null)
    {
        return ActionInterface::ACTION_MANAGE_COMPANY;
    }

    /**
     * @return array
     */
    public function data($data = null)
    {
        return [
            'payload' => [
                'locale' => 'es-CO',
                'documentType' => 'NIT',
                'document' => '900000000',
                'legalName' => 'Test Inc.',
                'status' => 'ACTIVE',
                'country' => 'COL',
                'state' => '05',
                'city' => '001',
                'incomeEnable' => [
                    'code' => [
                        'COMPANY_REGISTER',
                        'CONSUMER_BEER',
                    ],
                ],
                // Optional
                'comercialName' => 'Testing',
                'telephone' => '4442310',
                'address' => 'Calle 53 # 42-112',
            ]
        ];
    }
}
