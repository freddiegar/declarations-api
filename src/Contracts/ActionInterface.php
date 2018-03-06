<?php

namespace PlacetoPay\DeclarationClient\Contracts;

/**
 * Interface ActionInterface
 * @package app\Contracts
 */
interface ActionInterface
{
    const ACTION_CREATE_REQUEST = 'createRequest';
    const ACTION_INFORMATION_REQUEST = 'informationRequest';
    const ACTION_GET_PDF_REQUEST = 'getPdfRequest';
    const ACTION_MANAGE_COMPANY = 'manageCompany';
    const ACTION_MANAGE_COMPANY_BIDDER = 'manageCompanyBidder';
}
