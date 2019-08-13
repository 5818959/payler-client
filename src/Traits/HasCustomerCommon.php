<?php

namespace Payler\Traits;

trait HasCustomerCommon
{
    /**
     * Get the customer saved card status.
     */
    public function getStatusSaveCard()
    {
        // TODO implements
    }

    /**
     * Get the customer saved cards list.
     */
    public function getCardList()
    {
        // TODO implements
    }

    /**
     * Remove the customer saved card.
     */
    public function removeCard()
    {
        // TODO implements
    }

    /**
     * Register the customer.
     *
     * @param array $payload Request parameters
     */
    public function customerRegister(array $payload)
    {
        return $this->request('CustomerRegister', $payload);
    }

    /**
     * Update the customer information.
     *
     * @param string $customerId Customer id
     * @param array  $payload    Request parameters
     */
    public function customerUpdate(string $customerId, array $payload)
    {
        $payload['customer_id'] = $customerId;

        return $this->request('CustomerUpdate', $payload);
    }

    /**
     * Delete the customer.
     *
     * @param string $customerId Customer id
     */
    public function customerDelete(string $customerId)
    {
        return $this->request('CustomerDelete', ['customer_id' => $customerId]);
    }

    /**
     * Get the customer status.
     *
     * @param string $customerId Customer id
     */
    public function customerGetStatus(string $customerId)
    {
        return $this->request('CustomerGetStatus', ['customer_id' => $customerId]);
    }
}
