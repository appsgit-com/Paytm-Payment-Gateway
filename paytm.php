<?php

require_once 'validatePaytm.php';

$imapaddress       = "{imap.gmail.com:993/imap/ssl}";
$imapmainbox       = "INBOX";
$imapaddressandbox = $imapaddress . $imapmainbox;
$connection = imap_open($imapaddressandbox, $gmailuser, $gmailpassword) or die(json_encode(array(
    "type" => "error",
    "msg" => "Could not connect to the peer due to internal server error."
)));


//Connection established to the mail server, now search the transaction
$matchTxn = imap_search($connection, 'TEXT ' . $txnid . '"');
if ($matchTxn !== false) {
    //get message id
    $a         = var_export($matchTxn, true);
    $data      = $a;
    $whatIWant = substr($data, strpos($data, ">") + 1);
    $to        = ", )";
    $c         = chop($whatIWant, $to);
    $d         = str_replace(",", "", $c);
    $e         = preg_replace('/\s+/', '', $d);
    
    //only if the certain amount was sent
    $mailbody = imap_body($connection, $e);
    $bodyvar  = var_export($mailbody, true);
    if (!strpos($bodyvar, "$amount")) {
        die(json_encode(array(
            "type" => "error",
            "msg" => "Transaction found, but not of Rs.$amount."
        )));
    }
    //delete that email to avoid multiple submissions
    $f = imap_mail_move($connection, "$e:$e", '[Gmail]/Bin');
    die(json_encode(array(
        "type" => "success",
        "msg" => "Verified"
    )));
} else {
    //not paid yet, throw error
    die(json_encode(array(
        "type" => "error",
        "msg" => "The transaction ID you entered was not found."
    )));
}


?>
