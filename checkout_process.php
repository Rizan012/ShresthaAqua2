<?php
session_start();
require 'vendor/autoload.php';
include('db.php');

// Check if the necessary POST data exists
if (!isset($_POST['total_price']) || !isset($_POST['user_id'])) {
    echo json_encode(['error' => 'Missing data']);
    exit();
}

$total_price = $_POST['total_price'];
$user_id = $_POST['user_id'];

// Debugging: Check if the values are correct
file_put_contents('debug.log', "Received total_price: $total_price, user_id: $user_id\n", FILE_APPEND);

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

\Stripe\Stripe::setApiKey('sk_test_51Quan5Dcz5SPEWVJQpOcSclxFf5LUJXAisKHDxaM5uroHUeyosdRsUUUDzWOOdlqP5QIlCdyClZj5RaUXT7DrbBG003WqovqYn'); // Replace with your secret key

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => ['name' => "Shrestha Aquarium Order"],
                'unit_amount' => $total_price * 100, // Convert to cents
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/success.php?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost/cancel.php',
    ]);

    echo json_encode(['id' => $checkout_session->id]); // Return session ID to frontend
} catch (Exception $e) {
    // Log the error message
    file_put_contents('debug.log', "Stripe error: " . $e->getMessage() . "\n", FILE_APPEND);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
