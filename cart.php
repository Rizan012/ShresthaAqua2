<?php
session_start();

// Check if cart is initialized
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Remove an item from the cart
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    unset($_SESSION['cart'][$product_id]);  // Remove item by ID
    header("Location: cart.php");
    exit();
}

include('db.php');

// Get the product details from the cart
$cart_items = [];
if (!empty($_SESSION['cart'])) {
    $cart_item_ids = implode(",", array_keys($_SESSION['cart']));
    $sql = "SELECT * FROM product WHERE id IN ($cart_item_ids)";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $cart_items[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Shrestha Aquarium</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            font-family: Poppins;
        }
        .cart-item {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .cart-item img {
            max-width: 100px;
            object-fit: contain;
            margin-right: 15px;
        }
        .cart-item-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .remove-btn {
            color: red;
            cursor: pointer;
        }
        .cart-total {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<header class="bg-dark text-white p-4">
    <div class="container">
        <a href="index.php" class="text-white">Back to Home</a>
    </div>
</header>

<main class="container py-5">
    <h2 class="text-center">Your Cart</h2>
    
    <?php if (empty($cart_items)): ?>
        <p class="text-center">Your cart is empty.</p>
    <?php else: ?>
        <div class="row">
            <?php
            $total_price = 0;
            foreach ($cart_items as $item):
                $item_id = $item['id'];
                $item_name = $item['name'];
                $item_price = $item['price'];
                $item_image = $item['image'];
                $item_quantity = $_SESSION['cart'][$item_id];
                $total_price += $item_price * $item_quantity;
            ?>
                <div class="col-md-12">
                    <div class="cart-item">
                        <div class="cart-item-info">
                            <img src="iuploads/<?php echo $item_image; ?>" alt="<?php echo $item_name; ?>">
                            <div>
                                <h5><?php echo $item_name; ?></h5>
                                <p>Price: $<?php echo $item_price; ?> | Quantity: <?php echo $item_quantity; ?></p>
                                <p>Total: $<?php echo $item_price * $item_quantity; ?></p>
                            </div>
                            <a href="cart.php?remove=<?php echo $item_id; ?>" class="remove-btn">Remove</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-end cart-total">
            <p>Total: $<?php echo $total_price; ?></p>
        </div>
    <?php endif; ?>
</main>

<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>&copy; 2024 Shrestha Aquarium. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
