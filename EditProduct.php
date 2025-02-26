<?php
session_start();
include 'Connection.php'; // Make sure this file sets up $conn correctly

// Query to fetch all products
$query = "SELECT * FROM products";
$result = $conn->query($query);

if (!$result) {
    die("Database query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products</title>
    <link rel="stylesheet" href="CSS/EditProduct.css">
</head>
<body>

<section class='products'>
<div class="product-container">
<h1>All Products</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <!-- Replace the keys with your actual column names -->
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['price']); ?></td>
            <td><a href="editCategory.php?id=<?php echo $cat['id']; ?>" class="edit-link">Edit</a>
            <a href="deleteCategory.php?id=<?php echo $cat['id']; ?>" class="delete-link" onclick="return confirm('Wil je echt <?php echo htmlspecialchars($row['name']); ?> verwijderen? ')">Delete</a></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</div>
</section>
</body>
</html>