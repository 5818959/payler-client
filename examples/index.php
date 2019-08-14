<?php

require_once __DIR__ . '/config.php';

$data = @file_get_contents(THREEDS_JSON_FILE);
if (!empty($data)) {
    $data = json_decode($data, true);
} else {
    echo 'No 3DS data.' . PHP_EOL;

    exit(1);
}

if (!isset($data['acs_url'])) {
    echo 'No 3DS data.' . PHP_EOL;

    exit(1);
}

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

    <form id="redirect" method="POST" action="<?= $data['acs_url']; ?>">
        <input type="hidden" name="md" value="<?= $data['md']; ?>">
        <input type="hidden" name="pareq" value="<?= $data['pareq']; ?>">
        <input type="hidden" name="termurl" value="<?= THREEDS_ENDPOINT; ?>">
    </form>
    <script type="text/javascript">
        (function () {
            document.getElementById('redirect').submit();
        })();
    </script>

</body>
</html>
