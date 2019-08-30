<?php

namespace Payler\Clients;

use Payler\Apis\CreditMerchant as CreditMerchantApi;
use Payler\Clients\Client as PaylerClient;
use Payler\Traits\HasCreditCommon;
use Payler\Traits\HasCustomerCommon;
use Payler\Traits\HasCustomerMerchant;

/**
 * Credit Merchant API client.
 */
class CreditMerchantClient extends PaylerClient implements CreditMerchantApi
{
    use HasCreditCommon;
    use HasCustomerCommon;
    use HasCustomerMerchant;

    /**
     * Documentation version.
     */
    const VERSION = '1.0.2';

    /**
     * API URL.
     */
    const API_URL = '/cmapi/';

    /**
     * Transfer funds to the card.
     *
     * @param string      $orderId    Order id
     * @param integer     $amount     Payment amount
     * @param integer     $cardNumber Card number
     * @param string      $email      Customer email
     * @param array       $payload    Request parameters
     */
    public function credit(
        string $orderId,
        int $amount,
        string $cardNumber,
        string $email,
        array $payload = []
    ) {
        $payload['password'] = $this->password;
        $payload['order_id'] = $orderId;
        $payload['amount'] = $amount;
        $payload['card_number'] = $cardNumber;
        $payload['email'] = $email;

        return $this->request('Credit', $payload);
    }
}
