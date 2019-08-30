<?php

namespace Payler\Clients;

use Payler\Apis\Common as CommonApi;
use Payler\Apis\CustomerCommon as CustomerCommonApi;
use Payler\Clients\Client as PaylerClient;
use Payler\Traits\HasCustomerCommon;

/**
 * Common API client.
 */
class CommonClient extends PaylerClient implements CommonApi, CustomerCommonApi
{
    use HasCustomerCommon;

    /**
     * Documentation version.
     */
    const VERSION = '1.0.2';

    /**
     * Get payment status.
     *
     * @param string $orderId Order id
     */
    public function getStatus(string $orderId)
    {
        return $this->request('GetStatus', ['order_id' => $orderId]);
    }

    /**
     * Get extended payment status.
     *
     * @param string $orderId Order id
     */
    public function getAdvancedStatus(string $orderId)
    {
        return $this->request('GetAdvancedStatus', ['order_id' => $orderId]);
    }

}
