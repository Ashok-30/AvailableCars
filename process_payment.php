<?php
require 'PayPal-PHP-SDK/autoload.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Order;

$clientId = '';
$clientSecret = '';

$apiContext = new ApiContext(
    new OAuthTokenCredential($clientId, $clientSecret)
);

$apiContext->setConfig(['mode' => 'sandbox']);

$orderID = $_GET['orderID'];

try {
   
    $order = Order::get($orderID, $apiContext);

  

    echo 'Payment processed successfully';
} catch (Exception $ex) {
  
    echo $ex->getMessage();
}
?>