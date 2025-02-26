<?php

// Remove an item from the cart if requested
if (isset($_GET['remove'])) {
    $removeId = $_GET['remove'];
    if (isset($_SESSION['cart'][$removeId])) {
        unset($_SESSION['cart'][$removeId]);
    }
    // Redirect to avoid repeated removals on refresh
    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - V&D Webshop</title>
    <link rel="stylesheet" href="CSS/Cart.css">
</head>
<body>
<section class="cart-container">
    <h2>Your Shopping Cart</h2>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table class="cart-table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $grandTotal = 0;
            foreach ($_SESSION['cart'] as $productId => $item):
                $total = $item['price'] * $item['quantity'];
                $grandTotal += $total;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td>&euro;<?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>&euro;<?php echo number_format($total, 2); ?></td>
                    <td>
                        <a href="cart.php?remove=<?php echo $productId; ?>">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align:right;"><strong>Grand Total:</strong></td>
                <td>&euro;<?php echo number_format($grandTotal, 2); ?></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <div class="cart-actions">
            <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
            <a href="Index.php?page=HomePage" class="continue-shopping-btn">Continue Shopping</a>
        </div>
    <?php endif; ?>
<section>
</body>
</html>
