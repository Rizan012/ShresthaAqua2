<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include('db.php');

if (isset($_POST['remove'])) {
    $id = $_POST['id'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $quantity = max(1, (int)$_POST['quantity']); 
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Uniqca&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Poppins, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .cart-table th, .cart-table td {
            text-align: center;
            padding: 15px;
            vertical-align: middle;
        }
        .cart-table th {
            background-color: #f8f9fa;
            color: #333;
        }
        .cart-table td {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .cart-table img {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }
        .cart-total {
            font-size: 1.2rem;
            font-weight: bold;
            text-align: right;
        }
        .form-control {
            width: 100px;
            margin-right: 10px;
        }
        .btn-dark, .btn-success {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
        }
        .btn-dark:hover {
            background-color: #23272b;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-danger {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Shopping Cart</h2>
        <?php if (!empty($_SESSION['cart'])) { ?>
            <table class="table cart-table">
                <thead class="thead-dark">
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
                    <?php foreach ($_SESSION['cart'] as $id => $item) { 
                        $subtotal = $item['price'] * $item['quantity'];
                        $total_price += $subtotal;
                    ?>
                        <tr>
                            <td><img src="<?php echo (isset($item['is_fish']) && $item['is_fish']) ? 'uploads/' : 'iuploads/'; ?><?php echo $item['image']; ?>" alt="Product Image"></td>
                            <td><?php echo $item['name']; ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <form method="post" class="d-flex justify-content-center">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="form-control">
                                    <button type="submit" name="update" class="btn btn-sm btn-dark">Update</button>
                                </form>
                            </td>
                            <td>$<?php echo number_format($subtotal, 2); ?></td>
                            <td>
                                <form method="post" class="d-flex justify-content-center">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <button type="submit" name="remove" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="cart-total">
                <p>Total Price: $<?php echo number_format($total_price, 2); ?></p>
                <a href="fish_in.php" class="btn btn-dark">Continue Shopping</a>
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
