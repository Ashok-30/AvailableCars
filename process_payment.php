<?php
require 'PayPal-PHP-SDK/autoload.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Order;

$clientId = 'ARJHD9VfjQjXisLlgp_UvKmrnvaxTMfSyZi0y2CByy1BX0UFntHA5gR22HuMS93qb4H7EJQAKmaJoS0c';
$clientSecret = 'EK596tgj2Z7eLY4ZVNmq1_ryPx8GHUgET8danHSfIthwx4u_sO62-gCDoocI9cTDffPskPWeG0JBJPEk';

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