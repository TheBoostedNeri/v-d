<?php
ob_start();
session_start();
if (!isset($conn)) {
    include 'Connection.php';
}

require_once 'functions.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch categories for each gender.
// Adjust the strings ('man', 'woman', 'unisex') if your database stores them differently.
$menCategories    = getCategoriesByGender($conn, 'man');
$womenCategories  = getCategoriesByGender($conn, 'vrouw');
$unisexCategories = getCategoriesByGender($conn, 'unisex');
?>k
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>V&D Webshop</title>
    <link rel="stylesheet" href="CSS/Index.css">
</head>
<body>
<?php if (isset($_SESSION['user_id'])): ?>
    <?php if ($_SESSION['role'] === 'Admin'): ?>
        <header>
            <img class="logo" src="Images/V&D_logo.png" alt="V&D logo">
            <nav>
                <a href="Index.php?page=HomePage">Home</a>
                <div class="dropdown">
                    <a href="Index.php?page=categories">Categories ▼</a>
                    <div class="dropdown-menu">
                        <!-- Men Sub-Dropdown -->
                        <div class="sub-dropdown">
                            <a href="Index.php?page=categories&gender=man">Men ▶</a>
                            <div class="sub-menu">
                                <?php foreach ($menCategories as $cat): ?>
                                    <a href="Index.php?page=categories&gender=man&category=<?php echo urlencode($cat['category_name']); ?>">
                                        <?php echo htmlspecialchars($cat['category_name']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Women Sub-Dropdown -->
                        <div class="sub-dropdown">
                            <a href="Index.php?page=categories&gender=woman">Women ▶</a>
                            <div class="sub-menu">
                                <?php foreach ($womenCategories as $cat): ?>
                                    <a href="Index.php?page=categories&gender=woman&category=<?php echo urlencode($cat['category_name']); ?>">
                                        <?php echo htmlspecialchars($cat['category_name']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Unisex Sub-Dropdown -->
                        <div class="sub-dropdown">
                            <a href="Index.php?page=categories&gender=unisex">Unisex ▶</a>
                            <div class="sub-menu">
                                <?php foreach ($unisexCategories as $cat): ?>
                                    <a href="Index.php?page=categories&gender=unisex&category=<?php echo urlencode($cat['category_name']); ?>">
                                        <?php echo htmlspecialchars($cat['category_name']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="Index.php?page=EditCategories">Categorieën Beheren</a>
                <a href="Index.php?page=EditProduct">Product Beheren</a>
                <a href="Index.php?page=Logout">Uitloggen</a>
            </nav>
        </header>
    <?php elseif ($_SESSION['role'] === 'Klant'): ?>
        <header>
            <img class="logo" src="Images/V&D_logo.png" alt="V&D logo">
            <nav>
                <a href="Index.php?page=HomePage">Home</a>
                <div class="dropdown">
                    <a href="Index.php?page=categories">Categories ▼</a>
                    <div class="dropdown-menu">
                        <!-- Men Sub-Dropdown -->
                        <div class="sub-dropdown">
                            <a href="Index.php?page=categories&gender=man">Men ▶</a>
                            <div class="sub-menu">
                                <?php foreach ($menCategories as $cat): ?>
                                    <a href="Index.php?page=categories&gender=man&category=<?php echo urlencode($cat['category_name']); ?>">
                                        <?php echo htmlspecialchars($cat['category_name']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Women Sub-Dropdown -->
                        <div class="sub-dropdown">
                            <a href="Index.php?page=categories&gender=woman">Women ▶</a>
                            <div class="sub-menu">
                                <?php foreach ($womenCategories as $cat): ?>
                                    <a href="Index.php?page=categories&gender=woman&category=<?php echo urlencode($cat['category_name']); ?>">
                                        <?php echo htmlspecialchars($cat['category_name']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Unisex Sub-Dropdown -->
                        <div class="sub-dropdown">
                            <a href="Index.php?page=categories&gender=unisex">Unisex ▶</a>
                            <div class="sub-menu">
                                <?php foreach ($unisexCategories as $cat): ?>
                                    <a href="Index.php?page=categories&gender=unisex&category=<?php echo urlencode($cat['category_name']); ?>">
                                        <?php echo htmlspecialchars($cat['category_name']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="Index.php?page=cart">Cart</a>
                <a href="Index.php?page=Logout">Uitloggen</a>
            </nav>
        </header>
    <?php endif; ?>
<?php else: ?>
    <header>
        <img class="logo" src="Images/V&D_logo.png" alt="V&D logo">
        <nav>
            <a href="Index.php?page=HomePage">Home</a>
            <div class="dropdown">
                <a href="Index.php?page=categories">Categories ▼</a>
                <div class="dropdown-menu">
                    <!-- Men Sub-Dropdown -->
                    <div class="sub-dropdown">
                        <a href="Index.php?page=categories&gender=man">Men ▶</a>
                        <div class="sub-menu">
                            <?php foreach ($menCategories as $cat): ?>
                                <a href="Index.php?page=categories&gender=man&category=<?php echo urlencode($cat['category_name']); ?>">
                                    <?php echo htmlspecialchars($cat['category_name']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Women Sub-Dropdown -->
                    <div class="sub-dropdown">
                        <a href="Index.php?page=categories&gender=woman">Women ▶</a>
                        <div class="sub-menu">
                            <?php foreach ($womenCategories as $cat): ?>
                                <a href="Index.php?page=categories&gender=woman&category=<?php echo urlencode($cat['category_name']); ?>">
                                    <?php echo htmlspecialchars($cat['category_name']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Unisex Sub-Dropdown -->
                    <div class="sub-dropdown">
                        <a href="Index.php?page=categories&gender=unisex">Unisex ▶</a>
                        <div class="sub-menu">
                            <?php foreach ($unisexCategories as $cat): ?>
                                <a href="Index.php?page=categories&gender=unisex&category=<?php echo urlencode($cat['category_name']); ?>">
                                    <?php echo htmlspecialchars($cat['category_name']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <a href="Index.php?page=cart">Cart</a>
            <a href="Index.php?page=LoginPagina">Login / Register</a>
        </nav>
    </header>
<?php endif; ?>

<main>
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'] . ".php";
        if (file_exists($page)) {
            include($page);
        } else {
            echo "<h2>Page Not Found</h2>";
        }
    } else {
        include("HomePage.php"); // Default page
    }
    ?>
</main>

<footer>
    <div class="footer-container">
        <p>&copy; 2025 Nerijus Marciūnas</p>
    </div>
</footer>
</body>
</html>