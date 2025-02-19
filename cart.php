<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include('db.php');

// Get cart items
$sql = "SELECT * FROM cart 
        LEFT JOIN fish ON cart.fish_id = fish.id 
        LEFT JOIN product ON cart.product_id = product.id 
        WHERE cart.fish_id IS NOT NULL OR cart.product_id IS NOT NULL";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn)); 
}

// Update quantity
if (isset($_GET['update_quantity'])) {
    $cart_id = $_GET['update_quantity'];
    $quantity = $_GET['quantity'];

    if ($quantity > 0) {
        $sql_update = "UPDATE cart SET quantity = '$quantity' WHERE id = '$cart_id'";
        mysqli_query($conn, $sql_update);
    }
    header("Location: cart.php");
    exit();
}

// Remove item
if (isset($_GET['remove_from_cart'])) {
    $cart_id = $_GET['remove_from_cart'];
    $sql_remove = "DELETE FROM cart WHERE id = '$cart_id'";
    mysqli_query($conn, $sql_remove);
    header("Location: cart.php");
    exit();
}

// Calculate total
$total = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $price = $row['fish_id'] ? $row['price'] : $row['product_price'];
    $total += $price * $row['quantity'];
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
        * { font-family: Poppins; }
        .bg-colr { background-color: rgb(245, 245, 245); }
        .comp-name { font-family: "Unica One", serif; }
        footer { margin-top: auto; }
    </style>
</head>
<body>

<header class="bg-colr">
    <!-- Add Navbar here if required -->
</header>

<main class="container py-8">
    <h2 class="text-center mb-5 fw-7">Your Cart:</h2>
    <table class="table table-bordered shadow-sm">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>
                        <?php echo $row['fish_id'] ? $row['name'] : $row['product_name']; ?>
                    </td>
                    <td>
                        $<?php echo $row['fish_id'] ? $row['price'] : $row['product_price']; ?>
                    </td>
                    <td>
                        <form action="cart.php" method="get">
                            <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1" class="form-control w-50" required>
                            <input type="hidden" name="update_quantity" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </form>
                    </td>
                    <td>
                        <a href="cart.php?remove_from_cart=<?php echo $row['id']; ?>" class="btn btn-danger">Remove</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <h3 class="text-end">Total: $<?php echo number_format($total, 2); ?></h3>
    <div class="text-end">
        <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
    </div>
</main>

<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p class="comp-name">&copy; 2024 Shrestha Aquarium. All rights reserved.</p>
        <div>
            <a href="https://www.facebook.com/Shresthaaquarium2" target="_blank" class="text-white me-3">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook"
                     width="30">
            </a>
            <a href="https://instagram.com" target="_blank" class="text-white me-3">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/95/Instagram_logo_2022.svg" alt="Instagram"
                     width="30">
            </a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>
