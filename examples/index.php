<?php

require_once __DIR__ . '/config.php';

$data = @file_get_contents(THREEDS_JSON_FILE);
if (!empty($data)) {
    $data = json_decode($data, true);
} else {
    echo 'No 3DS data.' . PHP_EOL;

    exit(1);
}

if (!isset($data['type'])) {
    echo 'Invalid 3DS data.' . PHP_EOL;

    exit(1);
}

if (THREE_DS_V1 === $data['type']) {
    include __DIR__ . '/3ds_v1.php';

    exit(0);
}

if (THREE_DS_V2 === $data['type']) {
    include __DIR__ . '/3ds_v2.php';

    exit(0);
}

if (THREE_DS_V2_CHALLENGE === $data['type']) {
    include __DIR__ . '/3ds_v2_challenge.php';

    exit(0);
}
