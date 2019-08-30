<?php

namespace Payler\Apis;

interface CreditMerchant extends CreditCommon, CustomerMerchant
{
    /**
     * Transfer funds to the card.
     *
     * @param string  $orderId    Order id
     * @param integer $amount     Payment amount
     * @param string  $cardNumber Card number
     * @param string  $email      Customer email
     * @param array   $payload    Request parameters
     */
    public function credit(
        string $orderId,
        int $amount,
        string $cardNumber,
        string $email,
        array $payload = []
    );
}
