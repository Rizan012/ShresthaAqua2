<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include('db.php');

// Handle Remove from Cart
if (isset($_POST['remove'])) {
    $id = $_POST['id'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit();
}

// Handle Update Quantity
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $quantity = max(1, (int)$_POST['quantity']); // Ensure quantity is at least 1
    $_SESSION['cart'][$id]['quantity'] = $quantity;
    header("Location: cart.php");
    exit();
}

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Shrestha Aquarium</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unica+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {font-family: Poppins;}
        .cart-container { max-width: 800px; margin: 50px auto; }
        .cart-table img { width: 60px; height: 60px; object-fit: cover; }
        .cart-total { font-size: 1.2rem; font-weight: bold; }
    </style>
</head>
<body>
    

<div class="container cart-container">
    <h2 class="text-center mb-4">Shopping Cart</h2>
    <?php if (!empty($_SESSION['cart'])) { ?>
        <table class="table table-bordered cart-table">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $item) { 
                    $subtotal = $item['price'] * $item['quantity'];
                    $total_price += $subtotal;
                ?>
                    <tr>
                    <td><img src="<?php echo (isset($item['is_fish']) && $item['is_fish']) ? 'uploads/' : 'iuploads/'; ?><?php echo $item['image']; ?>" alt="Product Image"></td>
                        <td><?php echo $item['name']; ?></td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td>
                            <form method="post" class="d-flex">
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="form-control w-50 me-2">
                                <button type="submit" name="update" class="btn btn-sm btn-dark">Update</button>
                            </form>
                        </td>
                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <button type="submit" name="remove" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="text-end cart-total">
            <p>Total Price: $<?php echo number_format($total_price, 2); ?></p>

            <a href="fish_in.php" class="btn btn-secondary ms-2">Continue Shopping</a>
            
            <form action="checkout.php" method="get" style="display: inline;">
                <button type="submit" class="btn btn-success">Proceed to Checkout</button>
            </form>

        </div>
    <?php } else { ?>
        <p class="text-center">Your cart is empty.</p>
    <?php } ?>
</div>

</body>
</html>
