<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Payler\Clients\MerchantClient;
use Payler\Exceptions\PaylerException;

$client = new MerchantClient(PAYLER_BASE_URL, PAYLER_KEY, PAYLER_PASSWORD);

$recurrentTemplateId = 'rec-pay-3019599c-308d-473a-a939-dcd0d890d215-2d163c9707d0c1de51947a05eb9729d3';
// $cardId = 'DbdXJZVXlMrmEsJPWqjJxba5t5hS3e7YSS3y';
$orderId = time() . '-' . uniqid();
$amount = 100;

if (empty($recurrentTemplateId) && empty($cardId)) {
    echo 'WARNING!' . PHP_EOL . PHP_EOL
       . 'To run this example you should set $recurrentTemplateId or $cardId. Please edit example code.' . PHP_EOL;

    exit(1);
}

/**********************************************************************
 *
 * Template information
 *
 */

try {
    $response = $client->repeatPay($orderId, $amount, $recurrentTemplateId ?? null, $cardId ?? null);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

echo 'Repeat payment result:' . PHP_EOL;
echo "\torder_id:\t\t" . $response->order_id . PHP_EOL;
echo "\tamount:\t\t\t" . $response->amount . PHP_EOL;
echo "\tstatus:\t\t\t" . $response->status . PHP_EOL;

echo PHP_EOL;

/**********************************************************************
 *
 * Template information
 *
 */

try {
    $response = $client->getTemplate($recurrentTemplateId);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

echo 'Recurrent template:' . PHP_EOL;
echo "\trecurrent_template_id:\t" . $response->recurrent_template_id . PHP_EOL;
echo "\tcreated:\t\t" . $response->created . PHP_EOL;
echo "\tcard_holder:\t\t" . $response->card_holder . PHP_EOL;
echo "\tcard_number:\t\t" . $response->card_number . PHP_EOL;
echo "\texpiry:\t\t\t" . $response->expiry . PHP_EOL;
echo "\tactive:\t\t\t" . ($response->active ? 'true' : 'false') . PHP_EOL;

echo PHP_EOL;

/**********************************************************************
 *
 * Activate/deactivate template
 *
 */

try {
    $response = $client->activateTemplate($recurrentTemplateId, false);
} catch (PaylerException $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}

echo 'Recurrent template:' . PHP_EOL;
echo "\trecurrent_template_id:\t" . $response->recurrent_template_id . PHP_EOL;
echo "\tcreated:\t\t" . $response->created . PHP_EOL;
echo "\tcard_holder:\t\t" . $response->card_holder . PHP_EOL;
echo "\tcard_number:\t\t" . $response->card_number . PHP_EOL;
echo "\texpiry:\t\t\t" . $response->expiry . PHP_EOL;
echo "\tactive:\t\t\t" . ($response->active ? 'true' : 'false') . PHP_EOL;

exit(0);
