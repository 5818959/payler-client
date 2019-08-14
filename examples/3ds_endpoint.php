<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Payler\Clients\MerchantClient;

$client = new MerchantClient(PAYLER_BASE_URL, PAYLER_KEY, PAYLER_PASSWORD);

$result = @file_put_contents(THREEDS_JSON_FILE, json_encode([
    'pares' => $_POST['PaRes'],
    'md' => $_POST['MD'],
]));

if ($result === false) {
    echo 'Cant save response.' . PHP_EOL;

    exit(1);
}

echo 'Success.' . PHP_EOL;

exit(0);
