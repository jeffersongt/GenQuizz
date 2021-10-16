<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://opentdb.com/api.php?amount=20&type=boolean");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);

if (!$result) {
    $err = curl_error($ch);
    echo $err;
    return;
}
curl_close($ch);

$ret = json_decode(json_encode($result));
return $ret;

?>
