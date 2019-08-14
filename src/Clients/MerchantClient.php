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
     *
     * @param string $orderId    Order id
     * @param array  $payload    Request parameters
     * @param string $customerId Customer id
     * @param string $cardId     Card id
     */
    public function block(string $orderId, array $payload, string $customerId = null, string $cardId = null)
    {
        $payload['order_id'] = $orderId;

        if (isset($customerId)) {
            $payload['customer_id'] = $customerId;
        }

        if (isset($cardId)) {
            unset(
                $payload['card_number'],
                $payload['expired_year'],
                $payload['expired_month']
            );
            $payload['card_id'] = $cardId;
        }

        return $this->request('Block', $payload);
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
     *
     * @param string  $orderId   Order id
     * @param integer $newAmount Request parameters
     */
    public function retrieve(string $orderId, int $newAmount)
    {
        $payload = [
            'password' => $this->password,
            'order_id' => $orderId,
            'amount' => $newAmount,
        ];

        return $this->request('Retrieve', $payload);
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

    /**
     * Get extended payment status.
     *
     * @param string $paRes Payment authentication response
     * @param string $md    Merchant data
     */
    public function send3DS(string $paRes, string $md)
    {
        return $this->request('Send3DS', ['pares' => $paRes, 'md' => $md]);
    }
}
