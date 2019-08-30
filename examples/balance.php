<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Payler\Clients\CreditMerchantClient;
use Payler\Exceptions\PaylerException;

$client = new CreditMerchantClient(PAYLER_BASE_URL, PAYLER_KEY, PAYLER_PASSWORD);

/**********************************************************************
 *
 * Balance
 *
 */

try {
    $response = $client->getBalance();
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

echo 'Balance result:' . PHP_EOL;
if (isset($response->balance)) {
    foreach ($response->balance as $balance) {
        echo "\tname:\t\t" . $balance->name . PHP_EOL;
        echo "\tcurrency:\t" . $balance->currency . PHP_EOL;
        echo "\tremain:\t" . $balance->remain . PHP_EOL;
    }
}

echo PHP_EOL;

exit(0);
