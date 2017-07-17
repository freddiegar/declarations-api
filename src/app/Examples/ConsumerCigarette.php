<?php

namespace app\Examples;

use app\Contracts\ActionInterface;
use app\Models\Service;
use app\Traits\ReturnUrlTrait;

/**
 * Class ConsumerCigarette
 * @package app\Examples
 */
class ConsumerCigarette extends Service
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
                'locale' => 'es',
                'incomeType' => 'CONSUMER_CIGARETTE',
                'companyDocumentType' => 'NIT',
                'companyDocument' => '900299228',
                'additionalData' => [
                    'valueStrings' => [
                        [
                            'keyword' => 'bidder_type',
                            'value' => 'PRODUCER',
                        ],
                        [
                            'keyword' => 'bid_type',
                            'value' => 'INITIAL',
                        ],
                        [
                            'keyword' => 'year_taxable_period',
                            'value' => date('Y'),
                        ],
                        [
                            'keyword' => 'month_taxable_period',
                            'value' => date('m'),
                        ],
                        [
                            'keyword' => 'fortnight_taxable_period',
                            'value' => 1,
                        ],
                        [
                            'keyword' => 'value_tax_component_specific',
                            'value' => 2625000,
                        ],
                        [
                            'keyword' => 'value_tax_component_ad_valorem',
                            'value' => 327000,
                        ],
                        [
                            'keyword' => 'value_tax_resend_component_specific',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'value_tax_resend_component_ad_valorem',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'balance_favor_period_before',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'value_sanctions',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'value_for_taxes_penalties',
                            'value' => 2952000,
                        ],
                        [
                            'keyword' => 'balance_favor',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'payment_value_component_specific',
                            'value' => 2625000,
                        ],
                        [
                            'keyword' => 'payment_value_component_ad_valorem',
                            'value' => 327000,
                        ],
                        [
                            'keyword' => 'payment_value_penalties',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'payment_value_interest_due',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'total_to_pay',
                            'value' => 2952000,
                        ]
                    ],
                    'valueArrays' => [
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'T'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'TAB. ESOTERICO EL CONDOR DORADO'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'U-25'
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 500
                                ],
                                [
                                    'keyword' => 'standard_quantity',
                                    'value' => 625
                                ],
                                [
                                    'keyword' => 'value_tax_component_specific',
                                    'value' => 875000
                                ],
                                [
                                    'keyword' => 'value_tax_component_ad_valorem',
                                    'value' => 109000
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'T'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'TAB. ESOTERICO EL VIEJO JOSE'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'U-25'
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 1000
                                ],
                                [
                                    'keyword' => 'standard_quantity',
                                    'value' => 1250
                                ],
                                [
                                    'keyword' => 'value_tax_component_specific',
                                    'value' => 1750000
                                ],
                                [
                                    'keyword' => 'value_tax_component_ad_valorem',
                                    'value' => 218000
                                ],
                            ]
                        ],
                    ]
                ],
                'payment' => [
                    'amount' => 2952000,
                ],
                'returnUrl' => $this->returnUrl(),
            ]
        ];
    }
}
