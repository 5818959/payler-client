<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Payler\Clients\MerchantClient;
use Payler\Exceptions\PaylerException;

$orderId = '1625586244-60e47a44ba55e-test';

$client = new MerchantClient(PAYLER_BASE_URL, PAYLER_KEY, PAYLER_PASSWORD);

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
