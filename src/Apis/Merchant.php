<?php

namespace Payler\Apis;

interface Merchant extends CustomerCommon, CustomerMerchant
{
    /**
     * One step payment.
     */
    public function pay();

    /**
     * Block funds for two step payment.
     *
     * @param string $orderId    Order id
     * @param array  $payload    Request parameters
     * @param string $customerId Customer id
     * @param string $cardId     Card id
     */
    public function block(string $orderId, array $payload, string $customerId = null, string $cardId = null);

    /**
     * Charge funds in two step payment.
     */
    public function charge();

    /**
     * Retrieve block funds in two step payment.
     *
     * @param string  $orderId   Order id
     * @param integer $newAmount New amount
     */
    public function retrieve(string $orderId, int $newAmount);

    /**
     * Return funds.
     */
    public function refund();

    /**
     * Repeat recurrent payment.
     */
    public function repeatPay();

    /**
     * Get recurrent template information.
     */
    public function getTemplate();

    /**
     * Activate/deactivate recurrent template.
     */
    public function activateTemplate();

    /**
     * Get payment status.
     *
     * @param string $orderId Order id
     */
    public function getStatus(string $orderId);

    /**
     * Get extended payment status.
     *
     * @param string $orderId Order id
     */
    public function getAdvancedStatus(string $orderId);

    /**
     * Get extended payment status.
     *
     * @param string $paRes Payment authentication response
     * @param string $md    Merchant data
     */
    public function send3DS(string $paRes, string $md);
}
