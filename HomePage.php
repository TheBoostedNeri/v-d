<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>V&D Webshop</title>
    <link rel="stylesheet" href="CSS/HomePage.css">
</head>
<body>

<?php
if (!isset($conn)) {
    include 'Connection.php';
}
?>

<section class="products">
    <h2>Featured Products</h2>
    <div class="product-list">
        <?php
        $query = "SELECT * FROM products ORDER BY id DESC";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='product'>";
            echo "<div class='favorite'>";
            echo "<a href='Index.php?page=favorites&add=" . $row['id'] . "' class='favorite-link'>❤</a>";
            echo "</div>";
            echo "<img src='images/" . $row['image'] . "' alt='" . $row['name'] . "'>";
            echo "<h3>" . $row['name'] . "</h3>";
            echo "<p>€" . $row['price'] . "</p>";
            echo "<a href='Index.php?page=cart&add=" . $row['id'] . "'>Add to Cart</a>";
            echo "</div>";
        }
        ?>
    </div>
</section>
