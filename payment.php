<?php
require 'vendor/autoload.php'; // Stripe PHP SDK

// Include your Stripe configuration file
include('config.php');
include('db.php');

// Get the POST data
$data = json_decode(file_get_contents("php://input"), true);

$payment_method_id = $data['payment_method_id'];
$order_id = $data['order_id'];

// Fetch the order details (e.g., amount)
$query = "SELECT * FROM orders WHERE id = '$order_id'";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);

// Amount to charge (in cents)
$amount = $order['total'] * 100; // Example: $10.00 -> 1000 cents

// Set up Stripe API key
\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

// Create a PaymentIntent
try {
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $amount,
        'currency' => 'usd', // Change the currency if needed
        'payment_method' => $payment_method_id,
        'confirmation_method' => 'manual',
        'confirm' => true,
    ]);
    echo json_encode(['success' => true, 'paymentIntent' => $paymentIntent]);
} catch (\Stripe\Exception\CardException $e) {
    // Handle any errors
    echo json_encode(['error' => $e->getMessage()]);
}
?>
