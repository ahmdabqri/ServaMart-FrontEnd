<?php

session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$preloved_id = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT preloved_product.*, userr.name AS seller_name
     FROM preloved_product
     JOIN userr
     ON preloved_product.user_id = userr.user_id
     WHERE preloved_id = '$preloved_id'"
);

$product = mysqli_fetch_assoc($query);

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
    <link rel="stylesheet" href="productDetail.css">
    <link rel="stylesheet" href="spotlight.css">
    

    <title>Product Detail </title>
</head>

<header>
<nav class = "navbar">
    <div class = "logo">ServaMart</div>

    <div class="search-container">
        <img src="image/search.svg.svg" alt="Search" class="search-icon">
        <input type="text" id="search-input" placeholder="Search">
    </div>

    <div class="nav-menu">
        <button class="sell-button">SELL</button>

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
      
    <section class="product-detail-container">

    <div class="product-gallery">

        <img src="uploads/<?php echo $product['image']; ?>" class="main-image">

        <!--
        <div class="thumbnail-container">
            <img src="image/product 3.jpg" class="thumbnail">
            <img src="image/product detail 1.webp" class="thumbnail">
            <img src="image/product detail 2.webp" class="thumbnail">
            <img src="image/product detail 3.webp" class="thumbnail">
        </div> -->

    </div>

    <div class="product-info">

        <h1><?php echo $product['name']; ?></h1>

        <p class="price">RM <?php echo number_format($product['price'],2); ?></p>

        <p class="condition">Condition : <?php echo $product['condition']; ?></p>

        <p class="seller">Seller : <?php echo $product['seller_name']; ?></p>

        <div class="description">
            <h3>Description</h3>

            <p>
                <?php echo nl2br($product['description']); ?>
            </p>
        </div>

        <div class="action-button">

        <a href="add-cart.php?id=<?php echo $product['preloved_id']; ?>"><button class="cart-btn">
            Add To Cart
        </button></a>

        <button class="contact-btn">
        Contact Seller
        </button>

        </div>

    </div>

</section>
    
<script src="productDetail.js"></script>
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