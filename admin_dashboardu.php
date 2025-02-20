<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include('db.php'); 

// Fetch pending orders from the database
$sql = "SELECT * FROM orders WHERE status = 'pending'";
$result = mysqli_query($conn, $sql);

// Handle "Delete" or "Done" actions for orders
if (isset($_GET['action']) && isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $action = $_GET['action'];

    if ($action === 'delete') {
        $deleteSql = "DELETE FROM orders WHERE id = '$order_id'";
        if (mysqli_query($conn, $deleteSql)) {
            echo "<script>alert('Order removed successfully'); window.location.href = 'admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Error removing order: " . mysqli_error($conn) . "');</script>";
        }
    } elseif ($action === 'done') {
        $updateSql = "UPDATE orders SET status = 'successful' WHERE id = '$order_id'";
        if (mysqli_query($conn, $updateSql)) {
            echo "<script>alert('Order marked as Done'); window.location.href = 'admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Error updating order: " . mysqli_error($conn) . "');</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Shrestha Aquarium</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            font-family: Poppins;
        }
        .bg-colr {
            background-color: rgb(245, 245, 245);
        }
        .comp-name {
            font-family: "Unica One", serif;
        }
        .rounded-bottom-right {
            border-bottom-right-radius: 100px;
        }
        .py-8 {
            padding-top: 6rem;
            padding-bottom: 6rem;
        }
        .col-yel {
            background-color: #ddec01;
            border-color: #ddec01;
        }
        .text-yel {
            color: #ddec01;
        }
        .custom-shadow {
            box-shadow: 8px 8px 20px rgba(0, 0, 0, 0.8);
        }
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        footer {
          margin-top: auto;
        }

        .hero-section {
            padding-top: 6rem;
            padding-bottom: 6rem;
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

<header class="bg-colr">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fs-2 comp-name" href="#">
                <img src="logo.png" alt="Logo" width="36" height="36">
                <span class="comp-name">SHRESTHA AQUARIUM</span> <span class="comp-name text-yel">2</span>
            </a>
            <div class="d-flex ms-auto align-items-center">
                <?php if (isset($_SESSION['username'])): ?>
                    <div class="dropdown">
                        <button class="btn btn-dark col-yel rounded-pill fs-6 fw-bold text-dark px-4 py-2 custom-shadow dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['username']; ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a class="btn btn-dark col-yel rounded-pill fs-6 fw-bold text-dark px-4 py-2 custom-shadow" href="login.php">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<section class="hero-section">
    <div class="container">
        <h2 class="mb-5 text-center">Pending Orders</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Shipping Address</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['name']; ?></td>
                    <td><?php echo $order['address']; ?></td>
                    <td><?php echo $order['payment_method']; ?></td>
                    <td><?php echo $order['status']; ?></td>
                    <td>
                        <a href="admin_dashboard.php?action=done&order_id=<?php echo $order['id']; ?>" class="btn btn-success btn-sm">Mark as Done</a>
                        <a href="admin_dashboard.php?action=delete&order_id=<?php echo $order['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>

<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>© 2025 Fish Store. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
