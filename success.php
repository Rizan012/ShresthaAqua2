<?php
session_start();

// Clear the cart after successful payment
unset($_SESSION['cart']);

echo "<h2>Payment Successful!</h2>";
echo "<p>Thank you for your order.</p>";
?>
<a href="fish_in.php">Continue Shopping</a>
