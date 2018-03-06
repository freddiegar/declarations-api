<?php 

namespace PlacetoPay\DeclarationClient\Examples;

use PlacetoPay\DeclarationClient\Contracts\ActionInterface;
use PlacetoPay\DeclarationClient\Models\Service;
use PlacetoPay\DeclarationClient\Traits\ReturnUrlTrait;

/**
 * Class ConsumerBeer
 * @package app\Examples
 */
class ConsumerBeer extends Service
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
                'locale' => 'es-CO',
                'incomeType' => 'CONSUMER_BEER',
                'companyDocumentType' => 'NIT',
                'companyDocument' => '900000000',
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
                            'keyword' => 'tax_beers_siphons',
                            'value' => 938762000,
                        ],
                        [
                            'keyword' => 'tax_refajos_mixtures',
                            'value' => 8404000,
                        ],
                        [
                            'keyword' => 'tax_resend_beers_siphons',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'tax_resend_refajos_mixtures',
                            'value' => 26000,
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
                            'keyword' => 'value_corresponding_address_or_health_funds',
                            'value' => 156456000,
                        ],
                        [
                            'keyword' => 'value_for_taxes_penalties',
                            'value' => 947140000,
                        ],
                        [
                            'keyword' => 'balance_favor',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'payment_value_tax_beers_siphons',
                            'value' => 782280000,
                        ],
                        [
                            'keyword' => 'payment_value_tax_refajos_mixtures',
                            'value' => 8404000,
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
                            'value' => 790684000,
                        ]
                    ],
                    'valueArrays' => [
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'C'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'POKER (L)(330)(UND)'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'U-1-330'
                                ],
                                [
                                    'keyword' => 'retail_price',
                                    'value' => 1118
                                ],
                                [
                                    'keyword' => 'cost_packaging_and_containers',
                                    'value' => 342
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 47160
                                ],
                                [
                                    'keyword' => 'taxable_base',
                                    'value' => 36596160
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 48
                                ],
                                [
                                    'keyword' => 'tax_value',
                                    'value' => 17566157
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'C'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'CLUB COLOMBIA (L)(330)(UND)'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'U-1-330'
                                ],
                                [
                                    'keyword' => 'retail_price',
                                    'value' => 1271
                                ],
                                [
                                    'keyword' => 'cost_packaging_and_containers',
                                    'value' => 301
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 405032
                                ],
                                [
                                    'keyword' => 'taxable_base',
                                    'value' => 392881040
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 48
                                ],
                                [
                                    'keyword' => 'tax_value',
                                    'value' => 188582899
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'C'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'AGUILA LIGHT (L)(330)(UND)'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'U-1-330'
                                ],
                                [
                                    'keyword' => 'retail_price',
                                    'value' => 1219
                                ],
                                [
                                    'keyword' => 'cost_packaging_and_containers',
                                    'value' => 352
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 395436
                                ],
                                [
                                    'keyword' => 'taxable_base',
                                    'value' => 342843012
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 48
                                ],
                                [
                                    'keyword' => 'tax_value',
                                    'value' => 164564646
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'C'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'AGUILA (L)(330)(UND)'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'U-1-330'
                                ],
                                [
                                    'keyword' => 'retail_price',
                                    'value' => 1118
                                ],
                                [
                                    'keyword' => 'cost_packaging_and_containers',
                                    'value' => 342
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 790567
                                ],
                                [
                                    'keyword' => 'taxable_base',
                                    'value' => 613479992
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 48
                                ],
                                [
                                    'keyword' => 'tax_value',
                                    'value' => 294470396
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'R'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'COLA Y POLA PET (1500)(UND)'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'U-1-1500'
                                ],
                                [
                                    'keyword' => 'retail_price',
                                    'value' => 2326
                                ],
                                [
                                    'keyword' => 'cost_packaging_and_containers',
                                    'value' => 333
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 21084
                                ],
                                [
                                    'keyword' => 'taxable_base',
                                    'value' => 42020412
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 20
                                ],
                                [
                                    'keyword' => 'tax_value',
                                    'value' => 8404082
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'C'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'CONSTEÑA RN (350)(UND)'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'U-1-350'
                                ],
                                [
                                    'keyword' => 'retail_price',
                                    'value' => 843
                                ],
                                [
                                    'keyword' => 'cost_packaging_and_containers',
                                    'value' => 27
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 196830
                                ],
                                [
                                    'keyword' => 'taxable_base',
                                    'value' => 160613280
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 48
                                ],
                                [
                                    'keyword' => 'tax_value',
                                    'value' => 77094374
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'C'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'PILSEN (L)(473)(UND)'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'U-1-473'
                                ],
                                [
                                    'keyword' => 'retail_price',
                                    'value' => 1427
                                ],
                                [
                                    'keyword' => 'cost_packaging_and_containers',
                                    'value' => 505
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 129953
                                ],
                                [
                                    'keyword' => 'taxable_base',
                                    'value' => 119816666
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 48
                                ],
                                [
                                    'keyword' => 'tax_value',
                                    'value' => 57512000
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'C'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'AGUILA (L)(473)(UND)'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'U-1-330'
                                ],
                                [
                                    'keyword' => 'retail_price',
                                    'value' => 1426
                                ],
                                [
                                    'keyword' => 'cost_packaging_and_containers',
                                    'value' => 503
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 167993
                                ],
                                [
                                    'keyword' => 'taxable_base',
                                    'value' => 155057539
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 48
                                ],
                                [
                                    'keyword' => 'tax_value',
                                    'value' => 74427619
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'C'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'MILLER GD (L)(355)(UND)'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'U-1-355'
                                ],
                                [
                                    'keyword' => 'retail_price',
                                    'value' => 1606
                                ],
                                [
                                    'keyword' => 'cost_packaging_and_containers',
                                    'value' => 422
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 17256
                                ],
                                [
                                    'keyword' => 'taxable_base',
                                    'value' => 20431104
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 48
                                ],
                                [
                                    'keyword' => 'tax_value',
                                    'value' => 9806930
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'C'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'COSTEÑA R (L)(750)(UND)'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'U-1-750'
                                ],
                                [
                                    'keyword' => 'retail_price',
                                    'value' => 1499
                                ],
                                [
                                    'keyword' => 'cost_packaging_and_containers',
                                    'value' => 43
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 8640
                                ],
                                [
                                    'keyword' => 'taxable_base',
                                    'value' => 12579840
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 48
                                ],
                                [
                                    'keyword' => 'tax_value',
                                    'value' => 6038323
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'C'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'MILLER GD TW (355)(UND)'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'U-1-355'
                                ],
                                [
                                    'keyword' => 'retail_price',
                                    'value' => 1685
                                ],
                                [
                                    'keyword' => 'cost_packaging_and_containers',
                                    'value' => 342
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 38100
                                ],
                                [
                                    'keyword' => 'taxable_base',
                                    'value' => 49644300
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 48
                                ],
                                [
                                    'keyword' => 'tax_value',
                                    'value' => 23829264
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'class',
                                    'value' => 'C'
                                ],
                                [
                                    'keyword' => 'brand',
                                    'value' => 'POKER R (750)(UND)'
                                ],
                                [
                                    'keyword' => 'unit_measure',
                                    'value' => 'U-1-750'
                                ],
                                [
                                    'keyword' => 'retail_price',
                                    'value' => 1498
                                ],
                                [
                                    'keyword' => 'cost_packaging_and_containers',
                                    'value' => 40
                                ],
                                [
                                    'keyword' => 'quantity',
                                    'value' => 35536
                                ],
                                [
                                    'keyword' => 'taxable_base',
                                    'value' => 51811488
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 48
                                ],
                                [
                                    'keyword' => 'tax_value',
                                    'value' => 24869514
                                ],
                            ]
                        ]
                    ]
                ],
                'payment' => [
                    'amount' => rand(1000000, 6000000),
                ],
                'returnUrl' => $this->returnUrl(),
            ]
        ];
    }
}
