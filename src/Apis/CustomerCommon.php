<?php

namespace Payler\Apis;

interface CustomerCommon
{
    /**
     * Get the customer saved card status.
     *
     * @param string|null $cardId    Card id
     * @param string|null $sessionId Session id
     *
     * @throws \Payler\Exceptions\RequestException Wrong request
     */
    public function getStatusSaveCard(string $cardId = null, string $sessionId = null);

    /**
     * Get the customer saved cards list.
     *
     * @param string $customerId Customer id
     */
    public function getCardList(string $customerId);

    /**
     * Remove the customer saved card.
     *
     * @param string|null $cardId Card id
     */
    public function removeCard(string $cardId);

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
