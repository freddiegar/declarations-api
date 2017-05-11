<?php 

namespace app\Examples;

use app\Contracts\ActionInterface;
use app\Models\Service;
use app\Traits\ReturnUrlTrait;

/**
 * Class ConsumerRent
 * @package app\Examples
 */
class ConsumerRent extends Service
{
    use ReturnUrlTrait;

    /**
     * @return string
     */
    public function action()
    {
        return ActionInterface::ACTION_CREATE_REQUEST;
    }

    /**
     * @return array
     */
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
                'returnUrl' => $this->returnUrl(),
            ]
        ];
    }
}
