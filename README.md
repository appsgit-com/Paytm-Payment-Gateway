# Paytm PHP Payment Gateway (unofficial)
Unofficial PayTM Payment gateway API written in PHP, that asks user for his transaction ID (of sending PayTM cash) and matches if that ID exist with a certain amount. Contents: 1. Scenario, 2. Working, 3. Features, 4. Instructions.

**Scenario**:

 1. You are selling something for 2250 INR and want user to pay online.
 2. You ask user to send you Rs.2250 INR to your PayTM account.
 3. Once user sends, you ask him for his transaction ID.
 4. If the given transaction ID is associated with your PayTM account for 2250 INR then he is allowed to buy.

**How it works**:

Whenever someone sends you money using PayTM cash, you get an email from PayTM with the transaction ID and amount. This script looks your email (Gmail) and checks for the transaction ID and amount. Thus, GMail is used as a database.

**Features**:

1. Instant and automatic
2. Free, no transaction fees or any type or charge
3. Use it for any purpose you want
3. Secure, the code isn't vulnerable
4. No need of SSL certificate or PCI DSS compliance.
5. Open source, written in PHP 


**Instructions**:

Open file validatePaytm.php and enter a unique, secure and memorable API key, your Gmail email address and Gmail Password:

    //change these details
     $allowedkey    = "enter anything secure you can remember";
    $gmailuser     = "your gmail id registered on paytm";
    $gmailpassword = "your gmail password";
    //Nothing else to change now

Enable access to less secure apps and unlock captcha for your Google account using https://www.google.com/settings/security/lesssecureapps and https://accounts.google.com/b/0/DisplayUnlockCaptcha.

Send a HTTP POST request to paytm.php with required three POST parameters:

 1. **apikey**: Your API key that is in validatePaytm.php
 2. **txnid**: The transaction ID
 3. **amount**: Amount to check, eg. for Rs.1440 use 1440.0

A cURL example:

    curl "http://site.com/paytm.php" --data="apikey=blah&txnid=EIO1028EABC5564&amount=4411.0"
See example.php for a sample PHP code.

If you find any issue, do let know :)
