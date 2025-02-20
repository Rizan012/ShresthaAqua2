<?php 
session_start();
include('db.php');


if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}


$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);


$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Shrestha Aquarium</title>
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
        h2, h4 {
            color: #333;
        }
        table th, table td {
            text-align: center;
        }
        .btn-dark {
            background-color: #343a40;
            border-color: #343a40;
        }
        .btn-dark:hover {
            background-color: #23272b;
        }
        .form-group label {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Checkout</h2>
        <form action="process_order.php" method="POST">
            <h4>Your Order Summary</h4>
            <table class="table table-striped mb-4">
                <thead class="thead-dark">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    foreach ($_SESSION['cart'] as $item) {
                        $item_total = $item['price'] * $item['quantity'];
                        echo "<tr>";
                        echo "<td>{$item['name']}</td>";
                        echo "<td>\${$item['price']}</td>";
                        echo "<td>{$item['quantity']}</td>";
                        echo "<td>\${$item_total}</td>";
                        echo "</tr>";
                    }
                    ?>
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
                    </tr>
                </tbody>
            </table>

            <h4>Billing Details</h4>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Shipping Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <button type="submit" class="btn btn-dark btn-lg btn-block">Confirm Order</button>
        </form>
    </div>
</body>
</html>
