<?php

namespace Payler\Apis;

interface CustomerCommon
{
    /**
     * Get the customer saved card status.
     */
    public function getStatusSaveCard();

    /**
     * Get the customer saved cards list.
     */
    public function getCardList();

    /**
     * Remove the customer saved card.
     */
    public function removeCard();

    /**
     * Register the customer.
     *
     * @param array $payload Request parameters
     */
    public function customerRegister(array $payload);

    /**
     * Update the customer information.
     *
     * @param string $customerId Customer id
     * @param array  $payload    Request parameters
     */
    public function customerUpdate(string $customerId, array $payload);

    /**
     * Delete the customer.
     *
     * @param string $customerId Customer id
     */
    public function customerDelete(string $customerId);

    /**
     * Get the customer status.
     *
     * @param string $customerId Customer id
     */
    public function customerGetStatus(string $customerId);
}
