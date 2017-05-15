<?php 

namespace app\Examples;

use app\Contracts\ActionInterface;
use app\Models\Service;

/**
 * Class Company
 * @package app\Examples
 */
class CompanyError extends Service
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
                'locale' => 'en',
                'documentType' => 'NIT',
                'legalName' => 'Error Inc.',
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
