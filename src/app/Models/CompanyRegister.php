<?php 

namespace app\Models;

use app\Contracts\ServiceInterface;

class CompanyRegister extends Service implements ServiceInterface
{
    const ACTION = 'createRequest';

    public function data()
    {
        return [
            'payload' => [
                'locale' => 'es',
                'incomeType' => 'COMPANY_REGISTER',
                'companyDocument' => '900299228',
                'companyDocumentType' => 'NIT',
                'additionalData' => [
                    'valueStrings' => [
                        [
                            'keyword' => 'bidder',
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
                            'value' => '12',
                        ],
                        [
                            'keyword' => 'num_documents',
                            'value' => '1',
                        ],
                        [
                            'keyword' => 'total_register_tax_period',
                            'value' => rand(1000000, 2000000),
                        ],
                        [
                            'keyword' => 'minus_tax_interest_repayment',
                            'value' => rand(1000000, 2000000),
                        ],
                        [
                            'keyword' => 'minus_balance_favor_period_before',
                            'value' => rand(1000000, 2000000),
                        ],
                        [
                            'keyword' => 'more_sanctions',
                            'value' => rand(1000000, 2000000),
                        ],
                        [
                            'keyword' => 'total_balance_due_period',
                            'value' => rand(1000000, 2000000),
                        ],
                        [
                            'keyword' => 'total_balance_favor_period',
                            'value' => rand(1000000, 2000000),
                        ],
                        [
                            'keyword' => 'amount_to_paid',
                            'value' => rand(1000000, 2000000),
                        ],
                        [
                            'keyword' => 'amount_penalties',
                            'value' => rand(1000000, 2000000),
                        ],
                        [
                            'keyword' => 'interest_due',
                            'value' => rand(1000000, 2000000),
                        ],
                        [
                            'keyword' => 'total_to_pay',
                            'value' => rand(1000000, 2000000),
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
                                    'value' => 123
                                ],
                                [
                                    'keyword' => 'amount',
                                    'value' => 12345678
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 0.03
                                ],
                                [
                                    'keyword' => 'tax_amount_commerce',
                                    'value' => 456
                                ],
                                [
                                    'keyword' => 'tax_amount_stamp',
                                    'value' => 789
                                ],
                                [
                                    'keyword' => 'interest_amount',
                                    'value' => 012
                                ],
                            ],
                        ],
                        [
                            'keyword' => 'returns',
                            'value' => [
                                [
                                    'keyword' => 'document_class',
                                    'value' => 'ACTS_WITH_AMOUNT_CC'
                                ],
                                [
                                    'keyword' => 'number_acts',
                                    'value' => 998
                                ],
                                [
                                    'keyword' => 'amount',
                                    'value' => 9876
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 0.07
                                ],
                                [
                                    'keyword' => 'tax_amount_commerce',
                                    'value' => 765
                                ],
                                [
                                    'keyword' => 'tax_amount_stamp',
                                    'value' => 432
                                ],
                                [
                                    'keyword' => 'interest_amount',
                                    'value' => 321
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
                                    'value' => 123
                                ],
                                [
                                    'keyword' => 'amount',
                                    'value' => 12345678
                                ],
                                [
                                    'keyword' => 'rate',
                                    'value' => 0.03
                                ],
                                [
                                    'keyword' => 'tax_amount_commerce',
                                    'value' => 456
                                ],
                                [
                                    'keyword' => 'tax_amount_stamp',
                                    'value' => 789
                                ],
                                [
                                    'keyword' => 'interest_amount',
                                    'value' => 012
                                ],
                            ]
                        ]
                    ]
                ],
                'payment' => [
                    'amount' => rand(1000000, 2000000),
                ],
                'returnUrl' => 'https://www.google.com.co/',
            ]
        ];
    }
}
