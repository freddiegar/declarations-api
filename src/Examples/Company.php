<?php 

namespace FreddieGar\DeclarationApi\Examples;

use FreddieGar\DeclarationApi\Contracts\ActionInterface;
use FreddieGar\DeclarationApi\Models\Service;

/**
 * Class Company
 * @package app\Examples
 */
class Company extends Service
{
    /**
     * @return string
     */
    public function action()
    {
        return ActionInterface::ACTION_MANAGE_COMPANY;
    }

    /**
     * @return array
     */
    public function data()
    {
        return [
            'payload' => [
                'locale' => 'es',
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
                // Optional
                'comercialName' => 'Place to Pay',
                'telephone' => '4442310',
                'address' => 'Calle 53 # 42-112',
            ]
        ];
    }
}
