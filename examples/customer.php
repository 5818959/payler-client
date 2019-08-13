<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Payler\Clients\MerchantClient;
use Payler\Exceptions\PaylerException;

$client = new MerchantClient(PAYLER_BASE_URL, PAYLER_KEY, PAYLER_PASSWORD);

/**********************************************************************
 *
 * Register
 *
 */

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

/**********************************************************************
 *
 * Status
 *
 */

try {
    $response = $client->customerGetStatus($customerId);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

echo 'Customer status: ' . $response->status . PHP_EOL;

/**********************************************************************
 *
 * Update
 *
 */

$customerUpdate = [
    'customer_name' => 'customer_test',
    'customer_phone' => '70009999999',
    'customer_email' => 'customer@test',
    'customer_documentType' => 'Document type',
    'customer_documentSeria' => 'Document series',
    'customer_documentNumber' => 'Document number',
];

try {
    $response = $client->customerUpdate($customerId, $customerUpdate);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

echo 'Customer updated successfully: ' . $response->customer_id . PHP_EOL;

/**********************************************************************
 *
 * Delete
 *
 */

try {
    $response = $client->customerDelete($customerId);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

if ($response->changed) {
    echo 'Customer deleted successfully.' . PHP_EOL;
} else {
    echo 'Failed to delete customer.' . PHP_EOL;
}

exit(0);
