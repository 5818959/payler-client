<?php

$acsurl = 'http://localhost';
$md = 'string';
$pareq = 'string';
$termurl = 'http://localhost:8989/3ds_endpoint.php';

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

    <form id="redirect" method="POST" action="<?= $acsurl; ?>">
        <input type="hidden" name="md" value="<?= $md; ?>">
        <input type="hidden" name="pareq" value="<?= $pareq; ?>">
        <input type="hidden" name="termurl" value="<?= $termurl; ?>">
    </form>
    <script type="text/javascript">
        (function () {
            document.getElementById('redirect').submit();
        })();
    </script>

</body>
</html>
