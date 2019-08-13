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
     */
    public function customerUpdate()
    {
        // TODO implements
    }

    /**
     * Delete the customer.
     */
    public function customerDelete()
    {
        // TODO implements
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
