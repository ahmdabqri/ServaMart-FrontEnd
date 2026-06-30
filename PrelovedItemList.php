<?php
session_start();
include 'config.php';
include "navbarNotification.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<?php

$items = [];

/* PRELOVED FROM DATABASE */
$productQuery = mysqli_query(
    $conn,
    "SELECT * FROM preloved_product
    WHERE listing_status='Active'
    ORDER BY created_at DESC"
);

while($row = mysqli_fetch_assoc($productQuery)){
    $items[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="card.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="theme.css">
    <link rel="stylesheet" href="category.css">
    <link rel="stylesheet" href="spotlight.css">
    <link rel="stylesheet" href="PrelovedItemList.css">

    <title>Preloved List Page ServaMart</title>
</head>

<header>
<nav class = "navbar">
    <div class = "logo">
        <a href="homepage.php">
            <img src="image/logo.png" alt="ServaMart Logo">
        </a>
    </div>

    <div class="search-container">
        <img src="image/search.svg.svg" alt="Search" class="search-icon">
        <input type="text" id="search-input" placeholder="Search">
    </div>

    <div class="nav-menu">
        <a href="sell.php"><button class="sell-button">SELL</button></a>

 <a href="userProfile.php">

            <div class="profile-icon">

            <img src="image/profile-round-1342-svgrepo-com.svg">
        

            <?php
            if($totalNotification > 0){
            ?>

                <span class="profile-badge">
                    <?php echo $totalNotification; ?>
                </span>

            <?php
            }
            ?>

        </div>

        <span>Profile</span>

        </a>

        <a href="cart.php">
            <img src="image/cart-shopping-svgrepo-com.svg">
            <span>Cart</span>
        </a>

        </a>
    </div>

</nav>
</header>
<body>
      
    <div class="servamart-bg">

        <section class="page-header">
            <h1>Preloved Products</h1>

            <div class="sort-section">
                <label for="sort">Sort By :</label>

                <select id="sort">
                    <option value="latest">Latest</option>
                    <option value="low-high">Price: Low to High</option>
                    <option value="high-low">Price: High to Low</option>
                </select>

            </div>
        </section>

        <!-- PRODUCT GRID FROM DATABASE -->
        <section class="product-section">

        <div class="product-grid" id="product-grid">

            <p id="noResult" class="no-result" style="<?php echo (count($items) > 0) ? 'display:none;' : ''; ?>">
                No product found
            </p>

            <?php if(count($items) > 0){ ?>

            <?php foreach($items as $row){ ?>

            <div class="product-card" data-id="<?php echo $row['preloved_id']; ?>">
                <div class="product-image">
                    <img src="uploads/<?php echo $row['image']; ?>">
                </div>

                <h3><?php echo $row['name']; ?></h3>
                <p class="price" data-price="<?php echo $row['price']; ?>">RM <?php echo number_format($row['price'], 2); ?></p>

                <a href="product-detail.php?id=<?php echo $row['preloved_id']; ?>">
                    <button>View Details</button>
                </a>
            </div>

            <?php }} ?>

            <!-- STATIC PRODUCTS (DUMMY) -->

        </div>
        

    </section>

    </div>

    <script src="SortList.js"></script>
</body>

<footer class="footer">
    <div class="footer-left">
        <p>&#169 2026 UTeM ServaMart </p>
    </div>
    
</footer>
</html>