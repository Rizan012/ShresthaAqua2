<?php 
session_start();
include('db.php');

if (!isset($_GET['order_id'])) {
    echo "Order not found.";
    exit();
}

$order_id = $_GET['order_id'];


$query = "SELECT * FROM orders WHERE id = '$order_id'";
$result = mysqli_query($conn, $query);


if (mysqli_num_rows($result) == 0) {
    echo "Order not found.";
    exit();
}

$order = mysqli_fetch_assoc($result);


$query_items = "SELECT oi.*, p.name FROM order_items oi JOIN fish p ON oi.product_id = p.id WHERE oi.order_id = '$order_id'";
$result_items = mysqli_query($conn, $query_items);


if (!$result_items) {
    echo "Error fetching order items: " . mysqli_error($conn);
    exit();
}


if (mysqli_num_rows($result_items) == 0) {
    echo "No items found for this order.";
    exit();
}


$total = 0;
while ($item = mysqli_fetch_assoc($result_items)) {
    $total += $item['price'] * $item['quantity'];
}


mysqli_data_seek($result_items, 0);


$query_user = "SELECT * FROM users WHERE id = '{$order['user_id']}'";
$result_user = mysqli_query($conn, $query_user);
$user = mysqli_fetch_assoc($result_user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation | Shrestha Aquarium</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Uniqca&display=swap" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
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
            margin-bottom: 20px;
        }
        .order-table th, .order-table td {
            text-align: center;
            padding: 15px;
            vertical-align: middle;
        }
        .order-table th {
            background-color: #f8f9fa;
            color: #333;
        }
        .order-table td {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .order-total {
            font-size: 1.2rem;
            font-weight: bold;
            text-align: right;
        }
        .btn-primary, .btn-dark, .btn-success {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-dark {
            background-color: #23272b;
        }
        .btn-success {
            background-color: #218838;
        }
        .btn-dark:hover, .btn-success:hover {
            background-color: #1d2124;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Order Confirmation</h2>

    <h4>Order Details</h4>
    <p><strong>Order ID:</strong> <?php echo $order['id']; ?></p>
    <p><strong>Full Name:</strong> <?php echo $order['name']; ?></p>
    <p><strong>Shipping Address:</strong> <?php echo $order['address']; ?></p>
    <p><strong>Payment Method:</strong> <?php echo $order['payment_method']; ?></p>
    <p><strong>Status:</strong> <?php echo $order['status']; ?></p>

    <h4>Your Order Items</h4>
    <table class="table order-table">
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
            
            while ($item = mysqli_fetch_assoc($result_items)) {
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

    <form action="payment.php" method="POST" id="payment-form">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <div id="card-element"></div> 
        <button type="submit" id="submit" class="btn btn-primary">
            <span id="button-text">Proceed to Payment</span>
        </button>
        <div id="error-message"></div>
    </form>
</div>

<script type="text/javascript">
    var stripe = Stripe('pk_test_51Quan5Dcz5SPEWVJnMBrEdzDQUFzi8TC2Et63GwJKFt69TZAB8HgvsgmSwZ1yiElvCAwC9iln9b04ze7Y36DuV1Q00Q4LHaMm8');  // Use the publishable key here

    var form = document.getElementById('payment-form');
    var submitButton = document.getElementById('submit');
    var errorMessage = document.getElementById('error-message');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        fetch('create_checkout_session.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                order_id: "<?php echo $order_id; ?>"
            }),
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(sessionResponse) {
            if (sessionResponse.error) {
                errorMessage.textContent = sessionResponse.error;
            } else {
                // Redirect to Stripe Checkout
                stripe.redirectToCheckout({ sessionId: sessionResponse.sessionId })
                    .then(function(result) {
                        if (result.error) {
                            errorMessage.textContent = result.error.message;
                        }
                    });
            }
        })
        .catch(function(error) {
            errorMessage.textContent = error.message;
        });
    });
</script>

</body>
</html>
