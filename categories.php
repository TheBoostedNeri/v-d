<?php
include 'Connection.php';

// Get gender from URL (default to all products if not set)
$gender = isset($_GET['gender']) ? $_GET['gender'] : 'all';

// Prepare SQL query
if ($gender == 'all') {
    $query = "SELECT * FROM products";
} else {
    $query = "SELECT * FROM products WHERE gender = '$gender'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - V&D Webshop</title>
    <link rel="stylesheet" href="CSS/HomePage.css">
</head>
<body>

<section class="products">
    <h2><?php echo ucfirst($gender); ?> Collection</h2>
    <div class="product-list">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="product">
                <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <h3><?php echo $row['name']; ?></h3>
                <p>€<?php echo $row['price']; ?></p>
                <a href="cart.php?add=<?php echo $row['id']; ?>">Add to Cart</a>
            </div>
        <?php endwhile; ?>
    </div>
</section>

</body>
</html>
