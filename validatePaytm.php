<?php

//change these details
$allowedkey    = "enter anything secure you can remember";
$gmailuser     = "your gmail id registered on paytm";
$gmailpassword = "your gmail password";
//Nothing else to change now


//only continue if if request is POST for security reasons
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $op = json_encode(array(
        'type' => 'error',
        'msg' => 'Your browser sent a type of request that server could not understand'
    ));
    die($op);
}

if (!isset($_POST['apikey']) || empty($_POST['apikey'])) {
    $op = json_encode(array(
        'type' => 'error',
        'msg' => 'Forbidden'
    ));
    die($op);
}
if (!isset($_POST['txnid']) || empty($_POST['txnid'])) {
    $op = json_encode(array(
        'type' => 'error',
        'msg' => 'Please enter your transaction ID.'
    ));
    die($op);
}
if (!isset($_POST['amount']) || empty($_POST['amount'])) {
    $op = json_encode(array(
        'type' => 'error',
        'msg' => 'Please enter the amount.'
    ));
    die($op);
}

$txnid  = $_POST['txnid'];
$amount = $_POST['amount'];

//match API key
if ($_POST['apikey'] !== $allowedkey) {
    die(json_encode(array(
        "type" => "error",
        "msg" => "Forbidden."
    )));
}

//verification rules for transaction ID, for security reasons
if (strlen($txnid) < 10) {
    die(json_encode(array(
        "type" => "error",
        "msg" => "The transaction ID you entered was not found."
    )));
}

if (strlen($txnid) > 50) {
    die(json_encode(array(
        "type" => "error",
        "msg" => "The transaction ID you entered was not found."
    )));
}

if (!ctype_alnum($txnid)) {
    die(json_encode(array(
        "type" => "error",
        "msg" => "The transaction ID you entered was not found."
    )));
}

if (!preg_match('/^[0-9A-Z]*([0-9][A-Z]|[A-Z][0-9])[0-9A-Z]*$/', $txnid)) {
    die(json_encode(array(
        "type" => "error",
        "msg" => "The transaction ID you entered was not found."
    )));
}


//verification rule for amount for security reasons
if (strlen($amount) > 5) {
    die(json_encode(array(
        "type" => "error",
        "msg" => "Invalid amount."
    )));
}

?>
