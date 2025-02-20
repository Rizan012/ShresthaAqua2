<?php
$order_id = $_GET['order_id'];

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
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #218838; 
            margin-bottom: 20px;
        }
        .btn-primary, .btn-dark {
            padding: 12px 30px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-dark {
            background-color: #23272b;
            border-color: #23272b;
        }
        .btn-dark:hover {
            background-color: #1d2124;
        }
        .lead {
            font-size: 1.25rem;
            font-weight: 300;
            color: #333;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Payment Successful!</h2>
        <p class="lead">Thank you for your order! Your order ID is <strong><?php echo $order_id; ?></strong>.</p>
        <p>Your payment has been successfully processed. We are preparing your order for shipment.</p>
        <a href="dashboard_in.php" class="btn btn-dark mt-4">Go to Dashboard</a>
    </div>
</body>
</html>
