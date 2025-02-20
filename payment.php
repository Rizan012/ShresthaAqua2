<?php
require 'vendor/autoload.php'; 


include('config.php');
include('db.php');


$data = json_decode(file_get_contents("php://input"), true);

$payment_method_id = $data['payment_method_id'];
$order_id = $data['order_id'];


$query = "SELECT * FROM orders WHERE id = '$order_id'";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);


$amount = $order['total'] * 100; 


\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);


try {
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $amount,
        'currency' => 'usd', 
        'payment_method' => $payment_method_id,
        'confirmation_method' => 'manual',
        'confirm' => true,
    ]);
    echo json_encode(['success' => true, 'paymentIntent' => $paymentIntent]);
} catch (\Stripe\Exception\CardException $e) {
    
    echo json_encode(['error' => $e->getMessage()]);
}
?>
