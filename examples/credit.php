<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Payler\Clients\CreditMerchantClient;
use Payler\Exceptions\PaylerException;

$client = new CreditMerchantClient(PAYLER_BASE_URL, PAYLER_KEY, PAYLER_PASSWORD);

$orderId = time() . '-' . uniqid() . '-test';
$amount = 100;
$customerEmail = 'test_customer@localhost.test';
$card = [
    'card_number' => PAYLER_TEST_CARD_1_NUMBER,
    'card_holder' => PAYLER_TEST_CARD_1_HOLDER,
    'expired_year' => PAYLER_TEST_CARD_1_YEAR,
    'expired_month' => PAYLER_TEST_CARD_1_MONTH,
    'cvv' => PAYLER_TEST_CARD_1_CVV,
];

/**********************************************************************
 *
 * Credit merchant
 *
 */

$payload = [
    'currency' => 'RUB',
    'card_holder' => $card['card_holder'],
    'lang' => 'ru',
    'user_data' => 'test credit merchant user data',
    'user_entered_param1' => 'value1',
    'user_entered_param2' => 'value2',
];

try {
    $response = $client->credit($orderId, $amount, $card['card_number'], $customerEmail, $payload);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

echo 'Credit merchant result:' . PHP_EOL;
echo "\torder_id:\t\t" . $response->order_id . PHP_EOL;
echo "\tamount:\t\t\t" . $response->amount . PHP_EOL;
echo "\tcard_holder:\t\t" . $response->card_holder . PHP_EOL;
if (isset($response->card_number)) {
    echo "\tcard_number:\t\t" . $response->card_number . PHP_EOL;
}
echo "\tstatus:\t\t\t" . $response->status . PHP_EOL;

echo PHP_EOL;

/**********************************************************************
 *
 * Status
 *
 */

try {
    $response = $client->getStatus($orderId);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

echo 'Order status:' . PHP_EOL;
echo "\torder_id:\t\t" . $response->order_id . PHP_EOL;
echo "\tamount:\t\t\t" . $response->amount . PHP_EOL;
echo "\tstatus:\t\t\t" . $response->status . PHP_EOL;
if (isset($response->recurrent_template_id)) {
    echo "\trecurrent_template_id:\t" . $response->recurrent_template_id . PHP_EOL;
}
if (isset($response->payment_type)) {
    echo "\tpayment_type:\t\t" . $response->payment_type . PHP_EOL;
}

echo PHP_EOL;

exit(0);
