<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<?php

/* Handle sort selection (defaults to latest) */
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'latest';

switch($sort){
    case 'low-high':
        $orderBy = "price ASC";
        break;
    case 'high-low':
        $orderBy = "price DESC";
        break;
    case 'condition':
        $orderBy = "item_condition ASC";
        break;
    case 'rating':
        $orderBy = "rating DESC";
        break;
    default:
        $orderBy = "created_at DESC";
        break;
}

$items = [];

/* PRELOVED FROM DATABASE */
$productQuery = mysqli_query(
    $conn,
    "SELECT * FROM preloved_product
    WHERE status='Available'
    ORDER BY $orderBy"
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
    <div class = "logo">ServaMart</div>

    <div class="search-container">
        <img src="image/search.svg.svg" alt="Search" class="search-icon">
        <input type="text" id="search-input" placeholder="Search">
    </div>

    <div class="nav-menu">
        <a href="sell.php"><button class="sell-button">SELL</button></a>

        <a href="userProfile.php">
            <img src="image/profile-round-1342-svgrepo-com.svg">
            <span>Profile</span>
        </a>

        <a href="cart.php">
            <img src="image/cart-shopping-svgrepo-com.svg">
            <span>Cart</span>
        </a>

        <a href="chat.php">
            <img src="image/message-circle-chat-svgrepo-com.svg">
            <span>Message</span>
        </a>

        <a href="bookings.php">
            <img src="image/calendar-days-svgrepo-com.svg">
            <span>Booking</span>
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

                <select id="sort" onchange="location.href='PrelovedItemList.php?sort=' + this.value">
                    <option value="latest" <?php echo ($sort=='latest')?'selected':''; ?>>Latest</option>
                    <option value="low-high" <?php echo ($sort=='low-high')?'selected':''; ?>>Price: Low to High</option>
                    <option value="high-low" <?php echo ($sort=='high-low')?'selected':''; ?>>Price: High to Low</option>
                    <option value="condition" <?php echo ($sort=='condition')?'selected':''; ?>>Condition</option>
                    <option value="rating" <?php echo ($sort=='rating')?'selected':''; ?>>Rating</option>
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

            <div class="product-card">
                <div class="product-image">
                    <img src="uploads/<?php echo $row['image']; ?>">
                </div>

                <h3><?php echo $row['name']; ?></h3>
                <p class="price" data-price="<?php echo $row['price']; ?>">RM <?php echo number_format($row['price'], 2); ?></p>

                <a href="product-detail.php?id=<?php echo $row['preloved_id']; ?>">
                    <button>View Details</button>
                </a>
            </div>

            <?php } ?>

            <!-- STATIC PRODUCTS (DUMMY) -->

            <div class="product-card">
                <div class="product-image">
                    <img src="image/product 2.jpg">
                </div>
                <h3>Mechanical Keyboard</h3>
                <p class="price" data-price="80">RM 80.00</p>
                <button>View Details</button>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="image/product 4.jpg">
                </div>
                <h3>Wallet</h3>
                <p class="price" data-price="50">RM 50.00</p>
                <button>View Details</button>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="image/product 5.jpg">
                </div>
                <h3>Earpod</h3>
                <p class="price" data-price="120">RM 120.00</p>
                <button>View Details</button>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="image/product 6.jpg">
                </div>
                <h3>Powerbank</h3>
                <p class="price" data-price="70">RM 70.00</p>
                <button>View Details</button>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="image/product 7.jpg">
                </div>
                <h3>Aesthetic Carpet</h3>
                <p class="price" data-price="35">RM 35.00</p>
                <button>View Details</button>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="image/product 8.jpg">
                </div>
                <h3>Data Structure Book</h3>
                <p class="price" data-price="25">RM 25.00</p>
                <button>View Details</button>
            </div>

            <?php } ?>

        </div>

    </section>

    </div>

    <script src="SortList.js"></script>
</body>

<footer class="footer">
    <div class="footer-left">
        <p>&#169 2026 UTeM ServaMart </p>
    </div>
    <div class="footer-right">
        <a href="#">Help Centre</a>
        <span>|</span>
        <a href="#">Contact Us</a>
    </div>
    
</footer>
</html>