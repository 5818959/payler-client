<?php

namespace Payler\Clients;

use Payler\Apis\Merchant as MerchantApi;
use Payler\Clients\CommonClient as CommonClient;
use Payler\Exceptions\RequestException;
use Payler\Traits\HasCustomerMerchant;

/**
 * Merchant API client.
 */
class MerchantClient extends CommonClient implements MerchantApi
{
    use HasCustomerMerchant;

    /**
     * Documentation version.
     */
    const VERSION = '1.0.2';

    /**
     * API URL.
     */
    const API_URL = '/mapi/';

    /**
     * One step payment.
     *
     * @param string      $orderId    Order id
     * @param integer     $amount     Payment amount
     * @param string      $secureCode Card CVV code
     * @param string      $email      Customer email
     * @param array       $payload    Request parameters
     * @param string|null $customerId Customer id
     * @param string|null $cardId     Card id
     *
     * @throws \Payler\Exceptions\RequestException Wrong request
     */
    public function pay(
        string $orderId,
        int $amount,
        string $secureCode,
        string $email,
        array $payload = [],
        string $customerId = null,
        string $cardId = null
    ) {
        $payload['order_id'] = $orderId;
        $payload['amount'] = $amount;
        $payload['secure_code'] = $secureCode;
        $payload['email'] = $email;

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

        if (isset($payload['save_card']) && 1 === $payload['save_card'] && !isset($payload['customer_id'])) {
            throw new RequestException('The customer_id required if save_card is 1.');
        }

        return $this->request('Pay', $payload);
    }

    /**
     * Block funds for two step payment.
     *
     * @param string  $orderId    Order id
     * @param integer $amount     Payment amount
     * @param string  $secureCode Card CVV code
     * @param string  $email      Customer email
     * @param array   $payload    Request parameters
     * @param string  $customerId Customer id
     * @param string  $cardId     Card id
     *
     * @throws \Payler\Exceptions\RequestException Wrong request
     */
    public function block(
        string $orderId,
        int $amount,
        string $secureCode,
        string $email,
        array $payload = [],
        string $customerId = null,
        string $cardId = null
    ) {
        $payload['order_id'] = $orderId;
        $payload['amount'] = $amount;
        $payload['secure_code'] = $secureCode;
        $payload['email'] = $email;

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

        if (isset($payload['save_card']) && 1 === $payload['save_card'] && !isset($payload['customer_id'])) {
            throw new RequestException('The customer_id required if save_card is 1.');
        }

        return $this->request('Block', $payload);
    }

    /**
     * Charge funds in two step payment.
     *
     * @param string  $orderId Order id
     * @param integer $amount  Payment amount
     */
    public function charge(string $orderId, int $amount)
    {
        return $this->request('Charge', [
            'password' => $this->password,
            'order_id' => $orderId,
            'amount' => $amount,
        ]);
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
     *
     * @param string  $orderId Order id
     * @param integer $amount  Payment amount
     */
    public function refund(string $orderId, int $amount)
    {
        return $this->request('Refund', [
            'password' => $this->password,
            'order_id' => $orderId,
            'amount' => $amount,
        ]);
    }

    /**
     * Repeat recurrent payment.
     *
     * @param string      $orderId             Order id
     * @param integer     $amount              Amount
     * @param string|null $recurrentTemplateId Recurrent template id
     * @param string|null $cardId              Card id
     * @param array       $payload             Request parameters
     *
     * @throws \Payler\Exceptions\RequestException Wrong request
     */
    public function repeatPay(
        string $orderId,
        int $amount,
        string $recurrentTemplateId = null,
        string $cardId = null,
        array $payload = []
    ) {
        $payload['order_id'] = $orderId;
        $payload['amount'] = $amount;

        if (isset($recurrentTemplateId)) {
            $payload['recurrent_template_id'] = $recurrentTemplateId;

            return $this->request('RepeatPay', $payload);
        }

        if (isset($cardId)) {
            $payload['card_id'] = $cardId;

            return $this->request('RepeatPay', $payload);
        }

        throw new RequestException('You must set recurrent_template_id or card_id parameter.');
    }

    /**
     * Get recurrent template information.
     *
     * @param string $recurrentTemplateId Recurrent template id
     */
    public function getTemplate(string $recurrentTemplateId)
    {
        return $this->request('GetTemplate', ['recurrent_template_id' => $recurrentTemplateId]);
    }

    /**
     * Activate/deactivate recurrent template.
     *
     * @param string  $recurrentTemplateId Recurrent template id
     * @param boolean $active              Show if template should be activated (true) or deactivated (false)
     */
    public function activateTemplate(string $recurrentTemplateId, bool $active)
    {
        return $this->request('ActivateTemplate', [
            'recurrent_template_id' => $recurrentTemplateId,
            'active' => $active ? 1 : 0,
        ]);
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
