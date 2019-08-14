<?php

namespace Payler\Apis;

interface CustomerMerchant
{
    /**
     * Save the customer card.
     *
     * @param string $customerId Customer id
     * @param array  $payload    Request parameters
     */
    public function saveCard(string $customerId, array $payload);
}
