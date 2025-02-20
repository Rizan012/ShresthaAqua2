<?php
$order_id = $_GET['order_id'];
// You can fetch the order details from the database and show them to the user if needed.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success | Shrestha Aquarium</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Uniqca&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Poppins, sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            text-align: center;
        }
        .card {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-lg {
            padding: 12px 30px;
            font-size: 18px;
        }
        .lead {
            font-size: 1.25rem;
            font-weight: 300;
        }
        h2 {
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Payment Successful!</h2>
            <p class="lead">Thank you for your order! Your order ID is <strong><?php echo $order_id; ?></strong>.</p>
            <p>Your payment has been successfully processed. We are preparing your order for shipment.</p>
            <a href="dashboard_in.php" class="btn btn-dark btn-lg mt-4">Go to Dashboard</a>
        </div>
    </div>
</body>
</html>
