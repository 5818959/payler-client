<?php

namespace Payler\Apis;

interface CustomerMerchant
{
    /**
     * Save the customer card.
     *
     * @param string  $customerId   Customer id
     * @param string  $cardNumber   Card number
     * @param integer $expiredYear  Card expired year
     * @param integer $expiredMonth Card expired month
     * @param array   $payload      Request parameters
     */
    public function saveCard(
        string $customerId,
        string $cardNumber,
        int $expiredYear,
        int $expiredMonth,
        array $payload = []
    );
}
