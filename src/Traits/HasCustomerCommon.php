<?php

namespace Payler\Traits;

use Payler\Exceptions\RequestException;

trait HasCustomerCommon
{
    /**
     * Get the customer saved card status.
     *
     * @param string|null $cardId    Card id
     * @param string|null $sessionId Session id
     *
     * @throws \Payler\Exceptions\RequestException Wrong request
     */
    public function getStatusSaveCard(string $cardId = null, string $sessionId = null)
    {
        if (isset($cardId)) {
            return $this->request('GetStatusSaveCard', ['card_id' => $cardId]);
        }

        if (isset($sessionId)) {
            return $this->request('GetStatusSaveCard', ['session_id' => $sessionId]);
        }

        throw new RequestException('You must set card_id or session_id parameter.');
    }

    /**
     * Get the customer saved cards list.
     *
     * @param string|null $customerId Customer id
     */
    public function getCardList(string $customerId = null)
    {
        $payload = [];

        if (isset($customerId)) {
            $payload['customer_id'] = $customerId;
        }

        return $this->request('GetCardList', $payload);
    }

    /**
     * Remove the customer saved card.
     *
     * @param string $cardId Card id
     */
    public function removeCard(string $cardId)
    {
        return $this->request('RemoveCard', ['card_id' => $cardId]);
    }

    /**
     * Register the customer.
     *
     * @param array $payload Request parameters
     */
    public function customerRegister(array $payload = [])
    {
        return $this->request('CustomerRegister', $payload);
    }

    /**
     * Update the customer information.
     *
     * @param string $customerId Customer id
     * @param array  $payload    Request parameters
     */
    public function customerUpdate(string $customerId, array $payload = [])
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
