<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Payler\Clients\MerchantClient;
use Payler\Exceptions\PaylerException;

$customerId = '';

if (empty($customerId)) {
    echo 'WARNING!' . PHP_EOL . PHP_EOL
       . 'To run this example you should set $customerId. Please edit example code.' . PHP_EOL;

    exit(1);
}

$client = new MerchantClient(PAYLER_BASE_URL, PAYLER_KEY, PAYLER_PASSWORD);

/**********************************************************************
 *
 * Save
 *
 */

$card = [
    'card_number' => PAYLER_TEST_CARD_1_NUMBER,
    'card_holder' => PAYLER_TEST_CARD_1_HOLDER,
    'expired_year' => PAYLER_TEST_CARD_1_YEAR,
    'expired_month' => PAYLER_TEST_CARD_1_MONTH,
    'lang' => 'ru',
];

try {
    $response = $client->saveCard($customerId, $card);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

$cardId = $response->card_id;
echo 'Card saved successfully: ' . $cardId . PHP_EOL;
echo 'Card status: ' . $response->card_status . PHP_EOL;

/**********************************************************************
 *
 * Status
 *
 */

try {
    $response = $client->getStatusSaveCard($cardId);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

echo 'Card:' . PHP_EOL;
echo "\tid:\t\t\t" . $response->card_id . PHP_EOL;
echo "\tcard_status:\t\t" . $response->card_status . PHP_EOL;
echo "\tcard_number:\t\t" . $response->card_number . PHP_EOL;
echo "\tcard_holder:\t\t" . $response->card_holder . PHP_EOL;
echo "\texpired_year:\t\t" . $response->expired_year . PHP_EOL;
echo "\texpired_month:\t\t" . $response->expired_month . PHP_EOL;
if (isset($response->recurrent_template_id)) {
    echo "\trecurrent_template_id:\t" . $response->recurrent_template_id . PHP_EOL;
}
echo "\tcustomer_id:\t\t" . $response->customer_id . PHP_EOL;

/**********************************************************************
 *
 * Card list
 *
 */

try {
    $response = $client->getCardList($customerId);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

echo 'Customer cards:' . PHP_EOL;

if (count($response->cards)) {
    foreach ($response->cards as $card) {
        echo "\tcard_id:\t\t" . $card->card_id . PHP_EOL;
        echo "\tcard_status:\t\t" . $card->card_status . PHP_EOL;
        echo "\tcard_number:\t\t" . $card->card_number . PHP_EOL;
        echo "\tcard_holder:\t\t" . $card->card_holder . PHP_EOL;
        echo "\texpired_year:\t\t" . $card->expired_year . PHP_EOL;
        echo "\texpired_month:\t\t" . $card->expired_month . PHP_EOL;
        if (isset($card->recurrent_template_id)) {
            echo "\trecurrent_template_id:\t" . $card->recurrent_template_id . PHP_EOL;
        }
        echo "\tcustomer_id:\t\t" . $card->customer_id . PHP_EOL;
    }
} else {
    echo 'Customer has no cards.' . PHP_EOL;
}

/**********************************************************************
 *
 * Remove
 *
 */

try {
    $response = $client->removeCard($cardId);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

if ($response->changed) {
    echo 'Card removed successfully.' . PHP_EOL;
} else {
    echo 'Failed to remove card.' . PHP_EOL;
}

exit(0);
