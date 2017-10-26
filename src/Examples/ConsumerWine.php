<?php

namespace FreddieGar\DeclarationApi\Examples;

use FreddieGar\DeclarationApi\Contracts\ActionInterface;
use FreddieGar\DeclarationApi\Models\Service;
use FreddieGar\DeclarationApi\Traits\ReturnUrlTrait;

/**
 * Class ConsumerWine
 * @package app\Examples
 */
class ConsumerWine extends Service
{
    use ReturnUrlTrait;

    /**
     * @return string
     */
    public function action($action = null)
    {
        return ActionInterface::ACTION_CREATE_REQUEST;
    }

    /**
     * @return array
     */
    public function data($data = null)
    {
        return [
            'payload' => [
                'locale' => 'es',
                'incomeType' => 'CONSUMER_WINE',
                'companyDocumentType' => 'NIT',
                'companyDocument' => '900299228',
                'additionalData' => [
                    'valueStrings' => [
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
                            'value' => 432000,
                        ],
                        [
                            'keyword' => 'value_tax_component_ad_valorem',
                            'value' => 972000,
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
                            'value' => 1404000,
                        ],
                        [
                            'keyword' => 'balance_favor',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'payment_value_tax_participation',
                            'value' => 1404000,
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
                            'value' => 1404000,
                        ],
                        [
                            'keyword' => 'payment_health',
                            'value' => 519480,
                        ],
                        [
                            'keyword' => 'payment_sport',
                            'value' => 42120,
                        ],
                        [
                            'keyword' => 'payment_territorial_entity',
                            'value' => 842400,
                        ]

                    ],
                    'valueArrays' => [
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'V'
                                ],
                                [
                                    'keyword' => 'code_dane',
                                    'value' => '20003083'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'V. ALTA COCINA BLANCO SECO'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'MB'
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 48
                                ],
                                [
                                    'keyword' => 'value_base_component_specific',
                                    'value' => 8
                                ],
                                [
                                    'keyword' => 'value_tax_component_specific',
                                    'value' => 28800
                                ],
                                [
                                    'keyword' => 'value_participation_component_specific',
                                    'value' => 0
                                ],
                                [
                                    'keyword' => 'value_base_component_ad_valorem',
                                    'value' => 6900
                                ],
                                [
                                    'keyword' => 'value_tax_component_ad_valorem',
                                    'value' => 66240
                                ],
                                [
                                    'keyword' => 'value_participation_component_ad_valorem',
                                    'value' => 0
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'V'
                                ],
                                [
                                    'keyword' => 'code_dane',
                                    'value' => '20003083'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'V. ALTA COCINA BLANCO SECO'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'B'
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 240
                                ],
                                [
                                    'keyword' => 'value_base_component_specific',
                                    'value' => 8
                                ],
                                [
                                    'keyword' => 'value_tax_component_specific',
                                    'value' => 288800
                                ],
                                [
                                    'keyword' => 'value_participation_component_specific',
                                    'value' => 0
                                ],
                                [
                                    'keyword' => 'value_base_component_ad_valorem',
                                    'value' => 13799
                                ],
                                [
                                    'keyword' => 'value_tax_component_ad_valorem',
                                    'value' => 662400
                                ],
                                [
                                    'keyword' => 'value_participation_component_ad_valorem',
                                    'value' => 0
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'V'
                                ],
                                [
                                    'keyword' => 'code_dane',
                                    'value' => '20001391'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'V. ALTA COCINA TINTO SECO'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'MB'
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 72
                                ],
                                [
                                    'keyword' => 'value_base_component_specific',
                                    'value' => 8
                                ],
                                [
                                    'keyword' => 'value_tax_component_specific',
                                    'value' => 43200
                                ],
                                [
                                    'keyword' => 'value_participation_component_specific',
                                    'value' => 0
                                ],
                                [
                                    'keyword' => 'value_base_component_ad_valorem',
                                    'value' => 6327
                                ],
                                [
                                    'keyword' => 'value_tax_component_ad_valorem',
                                    'value' => 91080
                                ],
                                [
                                    'keyword' => 'value_participation_component_ad_valorem',
                                    'value' => 0
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'V'
                                ],
                                [
                                    'keyword' => 'code_dane',
                                    'value' => '20001391'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'V. ALTA COCINA TINTO SECO'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'B'
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 60
                                ],
                                [
                                    'keyword' => 'value_base_component_specific',
                                    'value' => 8
                                ],
                                [
                                    'keyword' => 'value_tax_component_specific',
                                    'value' => 72000
                                ],
                                [
                                    'keyword' => 'value_participation_component_specific',
                                    'value' => 0
                                ],
                                [
                                    'keyword' => 'value_base_component_ad_valorem',
                                    'value' => 12654
                                ],
                                [
                                    'keyword' => 'value_tax_component_ad_valorem',
                                    'value' => 151860
                                ],
                                [
                                    'keyword' => 'value_participation_component_ad_valorem',
                                    'value' => 0
                                ],
                            ]
                        ],
                    ]
                ],
                'payment' => [
                    'amount' => 1404000,
                    'credit_concept' => [
                        [
                            'entity_code' => '001',
                            'service_code' => '001',
                            'amount_Value' => 519480,
                            'tax_value' => 0,
                            'description' => ''
                        ],
                        [
                            'entity_code' => '001',
                            'service_code' => '002',
                            'amount_Value' => 42120,
                            'tax_value' => 0,
                            'description' => ''
                        ],
                        [
                            'entity_code' => '001',
                            'service_code' => '003',
                            'amount_Value' => 842400,
                            'tax_value' => 0,
                            'description' => ''
                        ],
                    ],
                ],
                'returnUrl' => $this->returnUrl(),
            ]
        ];
    }
}
