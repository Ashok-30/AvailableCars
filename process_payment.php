<?php
require 'PayPal-PHP-SDK/autoload.php';
$add_id = $_SESSION['pending_add_id'] ?? null;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Order;


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