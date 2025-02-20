<?php
require 'vendor/autoload.php'; 


include('config.php');
include('db.php');


$data = json_decode(file_get_contents("php://input"), true);
$order_id = $data['order_id'];


$query = "SELECT * FROM orders WHERE id = '$order_id'";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);


$query_items = "SELECT oi.*, p.name FROM order_items oi JOIN fish p ON oi.product_id = p.id WHERE oi.order_id = '$order_id'";
$result_items = mysqli_query($conn, $query_items);


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
            'unit_amount' => $item['price'] * 100, 
        ],
        'quantity' => $item['quantity'],
    ];
    $total += $item_total;
}


\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);


try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $line_items,  
        'mode' => 'payment',
        'success_url' => 'http://localhost/ecom/ShresthaAqua2/success.php?order_id=' . $order_id, 
        'cancel_url' => 'http://localhost/ecom/ShresthaAqua2/cancle.php?order_id=' . $order_id, 
    ]);

    
    echo json_encode(['sessionId' => $session->id]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
