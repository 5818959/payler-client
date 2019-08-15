<?php

namespace Payler\Traits;

trait HasCustomerMerchant
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
    ) {
        $payload['customer_id'] = $customerId;
        $payload['card_number'] = $cardNumber;
        $payload['expired_year'] = $expiredYear;
        $payload['expired_month'] = $expiredMonth;

        return $this->request('SaveCard', $payload);
    }
}
