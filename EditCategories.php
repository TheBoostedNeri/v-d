<?php
if (!isset($conn)) {
    include 'Connection.php';
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
require_once 'functions.php';

// Retrieve categories for each gender
$menCategories    = getCategoriesByGender($conn, 'Man');
$womenCategories  = getCategoriesByGender($conn, 'Vrouw');
$unisexCategories = getCategoriesByGender($conn, 'Unisex');
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
    <link rel="stylesheet" href="CSS/EditCategories.css">
</head>
<body>

<section class="vertical-container">
    <div class="first-container"></div>
    <h1>CATEGORIES</h1>

    <!-- MEN Block -->
    <div class="block-container">
        <table class="category-table">
            <thead>
            <tr>
                <th colspan="3">MEN</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($menCategories as $cat): ?>
                <tr>
                    <td><?php echo htmlspecialchars($cat['category_name']); ?></td>
                    <td><a href="editCategory.php?id=<?php echo $cat['id']; ?>" class="edit-link">Edit</a></td>
                    <td>
                        <a href="#deleteModal<?php echo $cat['id']; ?>" class="delete-link">Delete</a></td>
                </tr>

                <div id="deleteModal<?php echo $cat['id']; ?>" class="modal">
                    <div class="modal-content">
                        <a href="#" class="close-btn">&times;</a>
                        <h2>Delete</h2>
                        <p>Bent u zeker dat u dit wilt verwijderen?</p>
                        <div class="buttons">
                            <a href="deleteCategory.php?id=<?php echo $cat['id']; ?>" class="confirm-btn">Ja</a>
                            <a href="#" class="cancel-btn">Nee</a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
            <!-- "Toevoegen..." link points to #productModalMen -->
            <tr class="toevoegen-row">
                <td colspan="3">
                    <a href="#productModalMen">Toevoegen...</a>
                </td>
            </tr>

            <!-- Modal Structure -->
            <div id="productModalMen" class="modal">
                <div class="modal-content">
                    <!-- Close link points to an empty fragment (#), hiding the modal -->
                    <a href="#" class="close-btn">&times;</a>
                    <h2>MEN Categorie</h2>
                    <form action="EditCategories.php" method="POST" enctype="multipart/form-data">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>

                        <button type="submit" class="submit-btn">Opslaan</button>
                    </form>
                </div>
            </div>
            </tbody>
        </table>
    </div>

    <!-- WOMEN Block -->
    <div class="block-container">
        <table class="category-table">
            <thead>
            <tr>
                <th colspan="3">WOMEN</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($womenCategories as $cat): ?>
                <tr>
                    <td><?php echo htmlspecialchars($cat['category_name']); ?></td>
                    <td><a href="editCategory.php?id=<?php echo $cat['id']; ?>" class="edit-link">Edit</a></td>
                    <td><a href="#deleteModal<?php echo $cat['id']; ?>" class="delete-link">Delete</a></td>
                </tr>
            <?php endforeach; ?>
            <tr class="toevoegen-row">
                <td colspan="3"><a href="addCategory.php?gender=WOMEN">Toevoegen...</a></td>
            </tr>

            

            </tbody>
        </table>
    </div>

    <!-- UNISEX Block -->
    <div class="block-container">
        <table class="category-table">
            <thead>
            <tr>
                <th colspan="3">UNISEX</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($unisexCategories as $cat): ?>
                <tr>
                    <td><?php echo htmlspecialchars($cat['category_name']); ?></td>
                    <td><a href="editCategory.php?id=<?php echo $cat['id']; ?>" class="edit-link">Edit</a></td>
                    <td><a href="#deleteModal<?php echo $cat['id']; ?>" class="delete-link">Delete</a></td>
                </tr>
            <?php endforeach; ?>
            <tr class="toevoegen-row">
                <td colspan="3"><a href="addCategory.php?gender=UNISEX">Toevoegen...</a></td>
            </tr>
            </tbody>
        </table>
    </div>

</section>

<?php
// Close the database connection when done.
$conn->close();
?>

</body>
</html>