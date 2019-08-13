<?php

namespace Payler\Clients;

use Payler\Clients\Client as PaylerClient;
use Payler\Apis\Merchant as MerchantApi;
use Payler\Traits\HasCustomerCommon;
use Payler\Traits\HasCustomerMerchant;

/**
 * Merchant API client.
 */
class MerchantClient extends PaylerClient implements MerchantApi
{
    use HasCustomerCommon;
    use HasCustomerMerchant;

    /**
     * Documentation version.
     */
    const VERSION = '1.14';

    /**
     * API URL.
     */
    const API_URL = '/mapi/';

    /**
     * One step payment.
     */
    public function pay()
    {
        // TODO implement
    }

    /**
     * Block funds for two step payment.
     */
    public function block()
    {
        // code...
    }

    /**
     * Charge funds in two step payment.
     */
    public function charge()
    {
        // TODO implement
    }

    /**
     * Retrieve block funds in two step payment.
     */
    public function retrieve()
    {
        // code
    }

    /**
     * Return funds.
     */
    public function refund()
    {
        // TODO implement
    }

    /**
     * Repeat recurrent payment.
     */
    public function repeatPay()
    {
        // code...
    }

    /**
     * Get recurrent template information.
     */
    public function getTemplate()
    {
        // TODO implement
    }

    /**
     * Activate/deactivate recurrent template.
     */
    public function activateTemplate()
    {
        // TODO implement
    }

    /**
     * Get payment status.
     */
    public function getStatus()
    {
        // code...
    }

    /**
     * Get extended payment status.
     */
    public function getAdvancedStatus()
    {
        // TODO implement
    }
}
