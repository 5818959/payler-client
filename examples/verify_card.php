<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Payler\Clients\MerchantClient;
use Payler\PaymentStatus;

$client = new MerchantClient(PAYLER_BASE_URL, PAYLER_KEY, PAYLER_PASSWORD);

$customerId = '7wx9WZQy6NFkZgBR9pJHg6rwNoTHfPksQqKW';

if (empty($customerId)) {
    echo 'WARNING!' . PHP_EOL . PHP_EOL
       . 'To run this example you should set $customerId. Please edit example code.' . PHP_EOL;

    exit(1);
}

$customerEmail = 'test_customer@localhost.test';
$card = [
    'card_number' => PAYLER_TEST_CARD_2_NUMBER,
    'card_holder' => PAYLER_TEST_CARD_2_HOLDER,
    'expired_year' => PAYLER_TEST_CARD_2_YEAR,
    'expired_month' => PAYLER_TEST_CARD_2_MONTH,
    'secure_code' => PAYLER_TEST_CARD_2_CVV,
];
$orderId = time() . '-' . uniqid() . '-test';
$amount = 100;

$payment = [
    'currency' => 'RUB',
    'amount' => $amount,
    'email' => $customerEmail,
    'recurrent' => 1,
    'save_card' => 1,
];

$payload = array_merge($payment, $card);

try {
    $response = $client->block($orderId, $payload, $customerId);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

if ('1' == $response->auth_type) {
    @file_put_contents(THREEDS_JSON_FILE, json_encode([
        'acs_url' => $response->acs_url,
        'md' => $response->md,
        'pareq' => $response->pareq,
    ]));

    echo 'CAUTION!' . PHP_EOL
       . 'This payment require 3DS. Please open `examples/index.php` in browser.' . PHP_EOL
       . PHP_EOL;

    $timer = 60;
    echo 'Waiting for 3DS';
    do {
        echo '.';
        flush();

        $data = @file_get_contents(THREEDS_JSON_FILE);
        if (!empty($data)) {
            $data = json_decode($data, true);

            if (isset($data['pares']) && isset($data['md'])) {
                echo PHP_EOL;

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

    try {
        $response = $client->send3DS($data['pares'], $data['md']);
    } catch (PaylerException $e) {
        echo $e->getMessage() . PHP_EOL;

        exit(1);
    }
}

if (PaymentStatus::AUTHORIZED == $response->status) {
    if ($response->card_id) {
        echo 'Card saved successfully: ' . $response->card_id . PHP_EOL;
    } else {
        echo 'Failed to save card.' . PHP_EOL;
    }
    if ($response->recurrent_template_id) {
        echo 'Recurrent template: ' . $response->recurrent_template_id . PHP_EOL;
    } else {
        echo 'Failed to create recurrent template.' . PHP_EOL;
    }

    $response = $client->retrieve($orderId, $amount);
    if (PaymentStatus::REVERSED !== $response->status) {
        echo 'Failed to verify card. Payment status: ' . $response->status . PHP_EOL;

        exit(1);
    }
} else {
    echo 'Failed to verify card. Payment status: ' . $response->status . PHP_EOL;

    exit(1);
}

echo 'Card verified successfully.' . PHP_EOL;

exit(0);
