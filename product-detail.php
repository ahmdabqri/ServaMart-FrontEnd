<?php

session_start();
include 'config.php';
include "navbarNotification.php";

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
        <button class="sell-button">SELL</button>

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

        <?php
if($product['status']=="Available"){
?>
        <a href="add-cart.php?id=<?php echo $product['preloved_id']; ?>"><button class="cart-btn">
            Add To Cart
        </button></a>

        <?php
}
else{
?>

<button class="sold-btn" disabled>
    Sold Out
</button>

<p style="color:#ef4444;font-weight:600;margin-top:10px;">
    This item has already been sold.
</p>

<?php
}
?>

        </div>

    </div>

</section>
    
<script src="productDetail.js"></script>
</body>

<footer class="footer">
    <div class="footer-left">
        <p>&#169 2026 UTeM ServaMart </p>
    </div>

    
</footer>
</html>