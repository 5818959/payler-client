<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/3ds_functions.php';

use Payler\Clients\MerchantClient;

$client = new MerchantClient(PAYLER_BASE_URL, PAYLER_KEY, PAYLER_PASSWORD);

if (isset($_POST['threeDSMethodData'])) {
    try {
        $ascData = json_decode(base64url_decode($_POST['threeDSMethodData']));
        $threeDSServerTransID = $ascData->threeDSServerTransID;
    } catch (\Throwable $th) {
        throw $th;
    }

    $data = [
        'threeDS_server_transID' => $threeDSServerTransID,
    ];
} elseif (isset($_POST['cres'])) {
    $data = [
        'cres' => $_POST['cres'],
    ];
} else {
    $data = [
        'pares' => $_POST['PaRes'],
        'md' => $_POST['MD'],
    ];
}

$result = @file_put_contents(THREEDS_JSON_FILE, json_encode($data));

if ($result === false) {
    echo 'Cant save response.' . PHP_EOL;

    exit(1);
}

echo 'Success.' . PHP_EOL;

exit(0);
