<?php 

namespace PlacetoPay\DeclarationClient\Examples;

use PlacetoPay\DeclarationClient\Contracts\ActionInterface;
use PlacetoPay\DeclarationClient\Models\Service;
use PlacetoPay\DeclarationClient\Traits\ReturnUrlTrait;

/**
 * Class CompanyRegister
 * @package app\Examples
 */
class CompanyRegister extends Service
{
    use ReturnUrlTrait;

    /**
     * @param null $action
     * @return string
     */
    public function action($action = null)
    {
        return ActionInterface::ACTION_CREATE_REQUEST;
    }

    /**
     * @param array $data
     * @return array
     */
    public function data($data = null)
    {

        $totalToPay = rand(1000000, 2000000);

        return [
            'payload' => [
                'locale' => 'es-CO',
                'incomeType' => 'COMPANY_REGISTER',
                'companyDocumentType' => 'NIT',
                'companyDocument' => '900000000',
                'additionalData' => [
                    'valueStrings' => [
                        [
                            'keyword' => 'bidder_type',
                            'value' => 'CHAMBER_COMMERCE',
                        ],
                        [
                            'keyword' => 'bid_type',
                            'value' => 'INITIAL',
                        ],
                        [
                            'keyword' => 'year_taxable_period',
                            'value' => '2017',
                        ],
                        [
                            'keyword' => 'month_taxable_period',
                            'value' => '04',
                        ],
                        [
                            'keyword' => 'num_documents',
                            'value' => '2878',
                        ],
                        [
                            'keyword' => 'total_register_tax_period',
                            'value' => 5406292400,
                        ],
                        [
                            'keyword' => 'minus_tax_interest_repayment',
                            'value' => 20797300,
                        ],
                        [
                            'keyword' => 'minus_balance_favor_period_before',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'more_sanctions',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'total_balance_due_period',
                            'value' => 5385495100,
                        ],
                        [
                            'keyword' => 'total_balance_favor_period',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'amount_to_paid',
                            'value' => 5385495100,
                        ],
                        [
                            'keyword' => 'amount_penalties',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'interest_due',
                            'value' => 0,
                        ],
                        [
                            'keyword' => 'total_to_pay',
                            'value' => $totalToPay,
                        ]
                    ],
                    'valueArrays' => [
                        [
                            'keyword' => 'returns',
                            'value' => [
                                [
                                    'keyword' => 'document_class',
                                    'value' => 'ACTS_WITH_AMOUNT_CC'
                                ],

                                [
                                    'keyword' => 'number_acts',
                                    'value' => 25
                                ],
                                [
                                    'keyword' => 'amount',
                                    'value' => 1187028571
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 0.007
                                ],
                                [
                                    'keyword' => 'tax_amount_commerce',
                                    'value' => 8309200
                                ],
                                [
                                    'keyword' => 'tax_amount_stamp',
                                    'value' => 780800
                                ],
                                [
                                    'keyword' => 'interest_amount',
                                    'value' => 94400
                                ],
                            ],
                        ],
                        [
                            'keyword' => 'returns',
                            'value' => [
                                [
                                    'keyword' => 'document_class',
                                    'value' => 'ACTS_WITHOUT_AMOUNT_CC'
                                ],
                                [
                                    'keyword' => 'number_acts',
                                    'value' => 117
                                ],
                                [
                                    'keyword' => 'amount',
                                    'value' => 0
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 98400
                                ],
                                [
                                    'keyword' => 'tax_amount_commerce',
                                    'value' => 11498000
                                ],
                                [
                                    'keyword' => 'tax_amount_stamp',
                                    'value' => 0
                                ],
                                [
                                    'keyword' => 'interest_amount',
                                    'value' => 114900
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'document_class',
                                    'value' => 'ACTS_WITH_AMOUNT_CC'
                                ],
                                [
                                    'keyword' => 'number_acts',
                                    'value' => 1012
                                ],
                                [
                                    'keyword' => 'amount',
                                    'value' => 54399741726
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 0.007
                                ],
                                [
                                    'keyword' => 'tax_amount_commerce',
                                    'value' => 380802100
                                ],
                                [
                                    'keyword' => 'tax_amount_stamp',
                                    'value' => 699509900
                                ],
                                [
                                    'keyword' => 'interest_amount',
                                    'value' => 4638700
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'document_class',
                                    'value' => 'ACTS_WITH_AMOUNT_PRIMA'
                                ],
                                [
                                    'keyword' => 'number_acts',
                                    'value' => 19
                                ],
                                [
                                    'keyword' => 'amount',
                                    'value' => 1344681326102
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 0.003
                                ],
                                [
                                    'keyword' => 'tax_amount_commerce',
                                    'value' => 4034044700
                                ],
                                [
                                    'keyword' => 'tax_amount_stamp',
                                    'value' => 0
                                ],
                                [
                                    'keyword' => 'interest_amount',
                                    'value' => 4216700
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'document_class',
                                    'value' => 'ACTS_WITHOUT_AMOUNT_CC'
                                ],
                                [
                                    'keyword' => 'number_acts',
                                    'value' => 2897
                                ],
                                [
                                    'keyword' => 'amount',
                                    'value' => 0
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 98400
                                ],
                                [
                                    'keyword' => 'tax_amount_commerce',
                                    'value' => 285064800
                                ],
                                [
                                    'keyword' => 'tax_amount_stamp',
                                    'value' => 0
                                ],
                                [
                                    'keyword' => 'interest_amount',
                                    'value' => 2000500
                                ],
                            ]
                        ],
                        [
                            'keyword' => 'liquidations',
                            'value' => [
                                [
                                    'keyword' => 'document_class',
                                    'value' => 'ACTS_WITHOUT_AMOUNT_STAMP'
                                ],
                                [
                                    'keyword' => 'number_acts',
                                    'value' => 1
                                ],
                                [
                                    'keyword' => 'amount',
                                    'value' => 30000000
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 0.0005
                                ],
                                [
                                    'keyword' => 'tax_amount_commerce',
                                    'value' => 0
                                ],
                                [
                                    'keyword' => 'tax_amount_stamp',
                                    'value' => 15000
                                ],
                                [
                                    'keyword' => 'interest_amount',
                                    'value' => 0
                                ],
                            ]
                        ]
                    ]
                ],
                'payment' => [
                    'amount' => $totalToPay,
                ],
                'returnUrl' => $this->returnUrl(),
            ]
        ];
    }
}
