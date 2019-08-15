<?php

namespace Payler\Apis;

interface Merchant extends CustomerCommon, CustomerMerchant
{
    /**
     * One step payment.
     *
     * @param string      $orderId    Order id
     * @param integer     $amount     Payment amount
     * @param integer     $secureCode Card CVV code
     * @param string      $email      Customer email
     * @param array       $payload    Request parameters
     * @param string|null $customerId Customer id
     * @param string|null $cardId     Card id
     */
    public function pay(
        string $orderId,
        int $amount,
        int $secureCode,
        string $email,
        array $payload = [],
        string $customerId = null,
        string $cardId = null
    );

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
     *
     * @param string  $orderId Order id
     * @param integer $amount  Payment amount
     */
    public function refund(string $orderId, int $amount);

    /**
     * Repeat recurrent payment.
     *
     * @param string      $orderId             Order id
     * @param integer     $amount              Amount
     * @param string|null $recurrentTemplateId Recurrent template id
     * @param string|null $cardId              Card id
     *
     * @throws \Payler\Exceptions\RequestException Wrong request
     */
    public function repeatPay(string $orderId, int $amount, string $recurrentTemplateId = null, string $cardId = null);

    /**
     * Get recurrent template information.
     *
     * @param string $recurrentTemplateId Recurrent template id
     */
    public function getTemplate(string $recurrentTemplateId);

    /**
     * Activate/deactivate recurrent template.
     *
     * @param string  $recurrentTemplateId Recurrent template id
     * @param boolean $active              Show if template should be activated (true) or deactivated (false)
     */
    public function activateTemplate(string $recurrentTemplateId, bool $active);

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
