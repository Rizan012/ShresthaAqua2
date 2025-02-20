<?php
require 'vendor/autoload.php'; // Make sure Stripe PHP SDK is loaded

// Include Stripe configuration file
include('config.php');
include('db.php');

// Retrieve the order_id from the POST request
$data = json_decode(file_get_contents("php://input"), true);
$order_id = $data['order_id'];

// Fetch the order details from your database
$query = "SELECT * FROM orders WHERE id = '$order_id'";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);

// Fetch the order items (e.g., the products in the order)
$query_items = "SELECT oi.*, p.name FROM order_items oi JOIN fish p ON oi.product_id = p.id WHERE oi.order_id = '$order_id'";
$result_items = mysqli_query($conn, $query_items);

// Calculate the total amount for the order (in cents)
$total = 0;
$line_items = [];

while ($item = mysqli_fetch_assoc($result_items)) {
    $item_total = $item['price'] * $item['quantity'];
    $line_items[] = [
        'price_data' => [
            'currency' => 'usd',
            'product_data' => [
                'name' => $item['name'],
            ],
            'unit_amount' => $item['price'] * 100, // Convert to cents
        ],
        'quantity' => $item['quantity'],
    ];
    $total += $item_total;
}

// Set the API key
\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

// Create a Checkout session
try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $line_items,  // Add the line items here
        'mode' => 'payment',
        'success_url' => 'http://localhost/ecom/ShresthaAqua2/success.php?order_id=' . $order_id, // Redirect to success page
        'cancel_url' => 'http://localhost/ecom/ShresthaAqua2/cancle.php?order_id=' . $order_id, // Redirect to cancel page
    ]);

    // Return the session ID to the frontend
    echo json_encode(['sessionId' => $session->id]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
