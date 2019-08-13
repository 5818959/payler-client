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
     */
    public function customerUpdate();

    /**
     * Delete the customer.
     */
    public function customerDelete();

    /**
     * Get the customer status.
     *
     * @param string $customerId Customer id
     */
    public function customerGetStatus(string $customerId);
}
