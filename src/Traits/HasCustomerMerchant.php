<?php

namespace Payler\Traits;

trait HasCustomerMerchant
{
    /**
     * Save the customer card.
     *
     * @param string $customerId Customer id
     * @param array  $payload    Request parameters
     */
    public function saveCard(string $customerId, array $payload)
    {
        $payload['customer_id'] = $customerId;

        return $this->request('SaveCard', $payload);
    }
}
