<?php

$apikey = "mykey"
$txnid = "1B5D6E10FCE0019";
$amt   = "2250.0";
$onetime = "0";

$fields = array(
    'apikey' => urlencode($apikey),
    'txnid' => urlencode($txnid),
    'amount' => urlencode($amt),
    'onetime' => urlencode($onetime)
);

foreach ($fields as $key => $value) {
    $fields_string .= $key . '=' . $value . '&';
}
rtrim($fields_string, '&');


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://site.com/path/to/paytm.php");
curl_setopt($ch, CURLOPT_POST, count($fields));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
$result = curl_exec($ch);
curl_close($ch);

$json = json_decode($result);
if ($json->type !== 'error') {
    echo 'Transaction verified';
} else {
    die($json->msg);
}

?>
