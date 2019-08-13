<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Payler\Clients\MerchantClient;
use Payler\Exceptions\PaylerException;

$client = new MerchantClient(PAYLER_BASE_URL, PAYLER_KEY, PAYLER_PASSWORD);

$customer = [
    'customer_name' => 'test_customer',
    'customer_phone' => '79990000000',
    'customer_email' => 'test@customer.test',
    'customer_fullName' => 'Test Customer',
    'customer_address' => 'Test Customer address',
    'customer_documentType' => 'Test Customer document',
    'customer_documentSeria' => 'Test Customer document series',
    'customer_documentNumber' => 'Test Customer document number',
];

try {
    $response = $client->customerRegister($customer);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

$customerId = $response->customer_id;
echo 'Customer saved successfully: ' . $customerId . PHP_EOL;

try {
    $response = $client->customerGetStatus($customerId);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

echo 'Customer status: ' . $response->status . PHP_EOL;

exit(0);
