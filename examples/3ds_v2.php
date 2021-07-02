<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/3ds_functions.php';

$data = @file_get_contents(THREEDS_JSON_FILE);
if (!empty($data)) {
    $data = json_decode($data, true);
} else {
    echo 'No 3DS data.' . PHP_EOL;

    exit(1);
}

if (
    !isset($data['type'])
    || THREE_DS_V2 !== $data['type']
    || !isset($data['threeDS_server_transID'])
    || !isset($data['threeDS_method_url'])
) {
    echo 'Invalid 3DS 2.0 data.' . PHP_EOL;

    exit(1);
}

$body = base64url_encode(json_encode([
    'threeDSMethodNotificationURL' => '',
    'threeDSServerTransID' => '',
]));

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="max-age=0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
    <meta http-equiv="pragma" content="no-cache">
    <title>3DS</title>
</head>
<body>
    <!-- <iframe src="https://www.youtube.com/embed/X18mUlDddCc?autoplay=1" style="width:0;height:0;border:0; border:none;"></iframe> -->

    <p>Main page content.</p>

    <iframe></iframe>

    <script type="text/javascript">
        (function () {
            document.querySelector('iframe')
                .contentDocument.write(
                    '<form id="redirect" method="POST" action="<?= $data['threeDS_method_url']; ?>">'
                    + '<input type="textarea" name="threeDSMethodData" value="<?= $body; ?>">'
                    + '<input type="submit" value="send"></form>');

            // document.querySelector('iframe').contentDocument.forms[0].submit();
        })();
    </script>

</body>
</html>
