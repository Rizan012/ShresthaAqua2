<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $payment = $_POST['payment'];
    $total = 0;

    // Get user ID from session
    $user_id = $_SESSION['user_id'];

    // Insert the order into the orders table
    $query = "INSERT INTO orders (user_id, name, address, payment_method, total, status) VALUES ('$user_id', '$name', '$address', '$payment', '$total', 'pending')";
    mysqli_query($conn, $query);

    // Get the last inserted order ID
    $order_id = mysqli_insert_id($conn);

    // Insert cart items into the order_items table
    foreach ($_SESSION['cart'] as $item) {
        $item_total = $item['price'] * $item['quantity'];
        $total += $item_total;

        // Insert each item in the order
        $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '{$item['id']}', '{$item['quantity']}', '{$item['price']}')";
        mysqli_query($conn, $query);
    }

    // Update the order total
    $query = "UPDATE orders SET total = '$total' WHERE id = '$order_id'";
    mysqli_query($conn, $query);

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect to order confirmation or thank you page
    header("Location: order_confirmation.php?order_id=" . $order_id);
    exit();
}
?>
