<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Payler\Clients\MerchantClient;
use Payler\Exceptions\PaylerException;

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

$client = new MerchantClient(PAYLER_BASE_URL, PAYLER_KEY, PAYLER_PASSWORD);

/**********************************************************************
 *
 * Pay
 *
 */

$payment = [
    'currency' => 'RUB',
    'lang' => 'ru',
    'user_data' => 'test user data',
    'recurrent' => 1,
    'save_card' => 0,
    // 'user_entered_param1' => 'value1',
    // 'user_entered_param2' => 'value2',
    'payer_ip' => '192.230.72.13',
    'browserAccept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
    'browserLanguage' => 'ru',
    'browserUserAgent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3900.0 Iron Safari/537.36',
    'browserJavaEnabled' => true,
    'browserScreenHeight' => '800', // window.screen.height - Общая высота экрана устройства покупателя в пикселях
    'browserScreenWidth' => '600', // window.screen.width - Общая ширина экрана устройства покупателя в пикселях
    'browserColorDepth' => '24', // window.screen.colorDepth Глубина цветопередачи в битах
    'browserTZ' => '0', // Часовой пояс — разница (в минутах)
    'threeDsNotificationUrl' => '127.0.0.1'
];

$payload = array_merge($payment, $card);

try {
    $response = $client->pay($orderId, $amount, $card['cvv'], $customerEmail, $payload);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

echo 'Pay result:' . PHP_EOL;
echo "\torder_id:\t\t" . $response->order_id . PHP_EOL;
echo "\tamount:\t\t\t" . $response->amount . PHP_EOL;
echo "\tauth_type:\t\t" . $response->auth_type . PHP_EOL;
if (isset($payment['recurrent']) && !empty($payment['recurrent'])) {
    if (isset($response->recurrent_template_id)) {
        echo "\trecurrent_template_id:\t" . $response->recurrent_template_id . PHP_EOL;
    } else {
        echo "\trecurrent_template_id:\tFAILED" . PHP_EOL;
    }
}
if (isset($payment['save_card']) && !empty($payment['save_card'])) {
    if (isset($response->card_id)) {
        echo "\tcard_id:\t\t" . $response->card_id . PHP_EOL;
        echo "\tcard_status:\t\t" . $response->card_status . PHP_EOL;
    } else {
        echo "\tcard_id:\t\tFAILED" . PHP_EOL;
    }
}
echo "\tcard_number:\t\t" . $response->card_number . PHP_EOL;
echo "\tcard_holder:\t\t" . $response->card_holder . PHP_EOL;
echo "\texpired_year:\t\t" . $response->expired_year . PHP_EOL;
echo "\texpired_month:\t\t" . $response->expired_month . PHP_EOL;
if ('1' == $response->auth_type) {
    echo "\tacs_url:\t\t" . $response->acs_url . PHP_EOL;
    echo "\tmd:\t\t\t" . $response->md . PHP_EOL;
    echo "\tpareq:\t\t\t" . $response->pareq . PHP_EOL;
}
if (isset($response->status)) {
    echo "\tstatus:\t\t" . $response->status . PHP_EOL;
}

echo PHP_EOL;

if ('1' == $response->auth_type) {
    // check if 3ds 2.0 required
    if (isset($response->threeDS_server_transID) && !empty($response->threeDS_server_transID)) {
        // should call 3DSMethod()

        $threeDSData = [
            'type' => THREE_DS_V2,
            'threeDS_server_transID' => $response->threeDS_server_transID,
            'threeDS_method_url' => $response->threeDS_method_url,
        ];
    } elseif (isset($response->creq) && !empty($response->creq)) {
        // should call ChallengeComplete()

        $threeDSData = [
            'type' => THREE_DS_V2_CHALLENGE,
            'acs_url' => $response->acs_url,
            'creq' => $response->creq,
        ];
    } else {
        // 3DS 1.0

        $threeDSData = [
            'type' => THREE_DS_V1,
            'acs_url' => $response->acs_url,
            'md' => $response->md,
            'pareq' => $response->pareq,
            'termurl' => THREEDS_ENDPOINT,
        ];
    }

    @file_put_contents(THREEDS_JSON_FILE, json_encode($threeDSData));

    echo 'CAUTION!' . PHP_EOL
       . 'This payment require 3DS. Please open `examples/index.php` in browser.' . PHP_EOL
       . PHP_EOL;
}

$timer = 60;
echo 'Waiting for 3DS';
do {
    echo '.';
    flush();

    $data = @file_get_contents(THREEDS_JSON_FILE);
    if (!empty($data)) {
        $data = json_decode($data, true);

        if (isset($data['pares']) && isset($data['md'])) {
            break;
        }
    } else {
        echo 'No 3DS data at all.' . PHP_EOL;

        exit(1);
    }

    sleep(1);
} while (--$timer);

if (!$timer) {
    echo 'No 3DS response.' . PHP_EOL;

    exit(1);
}

echo PHP_EOL;

/**********************************************************************
 *
 * Send 3DS confirmation
 *
 */

try {
    $response = $client->send3DS($data['pares'], $data['md']);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

echo 'Send 3DS result:' . PHP_EOL;
echo "\torder_id:\t\t" . $response->order_id . PHP_EOL;
echo "\tamount:\t\t\t" . $response->amount . PHP_EOL;
echo "\tauth_type:\t\t" . $response->auth_type . PHP_EOL;
if (isset($response->recurrent_template_id)) {
    echo "\trecurrent_template_id:\t" . $response->recurrent_template_id . PHP_EOL;
}
if (isset($response->card_id)) {
    echo "\tcard_id:\t\t" . $response->card_id . PHP_EOL;
}
if (isset($response->card_status)) {
    echo "\tcard_status:\t\t" . $response->card_status . PHP_EOL;
}
if (isset($response->card_number)) {
    echo "\tcard_number:\t\t" . $response->card_number . PHP_EOL;
    echo "\tcard_holder:\t\t" . $response->card_holder . PHP_EOL;
    echo "\texpired_year:\t\t" . $response->expired_year . PHP_EOL;
    echo "\texpired_month:\t\t" . $response->expired_month . PHP_EOL;
}
if (isset($response->status)) {
    echo "\tstatus:\t\t\t" . $response->status . PHP_EOL;
}

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

/**********************************************************************
 *
 * Refund
 *
 */

try {
    $response = $client->refund($orderId, $amount);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

echo 'Payment refunded successfully.' . PHP_EOL;
echo 'Amount: ' . $response->amount . PHP_EOL;

echo PHP_EOL;

exit(0);
